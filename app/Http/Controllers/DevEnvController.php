<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;

use App\Http\Requests;

class DevEnvController extends Controller
{
    public function show()
    {
        return view('devenv.index');
    }

    public function compile(Request $request)
    {
        $terminalOut = '';
        $testCaseOut = '';

        $name = uniqid();
        $codefile = $name . '.c';
        $exefile = $name . '.exe';
        $logfile = $name . '.txt';

        Storage::put('codes/'.$codefile, $request->code);

        $outputGcc = shell_exec('gcc '.escapeshellarg(storage_path('app/codes/'.$codefile))
                .' -o '.escapeshellarg(storage_path('app/codes/progs/'.$exefile)).' 2>&1');

        if ($outputGcc !== NULL) {
            $terminalOut = $outputGcc;
        } else {
            if (count($request->testCases) == 0) {
                $outputExe = shell_exec(storage_path('app/codes/progs/'.$exefile).' 2>&1');
                $terminalOut = $outputExe;
            } else {
                $descriptorspec = [
                    ['pipe', 'r'],
                    ['pipe', 'w'],
                    ['file', storage_path('app/codes/logs/'.$logfile), 'a']
                ];

                foreach ($request->testCases as $testCase) {
                    $stdin = $testCase['input'];
                    $process = proc_open($exefile, $descriptorspec, $pipes, storage_path('app/codes/progs'));

                    if (is_resource($process)) {
                        fwrite ($pipes[0], $stdin);
                        fclose ($pipes[0]);

                        $output = stream_get_contents($pipes[1]);
                        fclose ($pipes[1]);

                        $terminalOut = $output;

                        $returnValue = proc_close($process);
                        // if (!$returnValue) {
                        //     $terminalOut .= file_get_contents('logs/'.$logfile);
                        //     $terminalOut .= "\n";
                        // }

                        if ($testCase['output'] === $output) {
                            $testCaseOut[] = true;
                        } else {
                            $testCaseOut[] = false;
                        }
                    }
                }
                Storage::delete('codes/logs/'.$logfile);
            }
            Storage::delete('codes/progs/'.$exefile);
        }
        Storage::delete('codes/'.$codefile);

        return response()->json([
            'terminalOut' => $terminalOut,
            'testCaseOut' => $testCaseOut
        ]);
    }
}
