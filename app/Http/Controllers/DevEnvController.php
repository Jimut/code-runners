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
        $name = uniqid();
        $codefile = $name . '.c';
        $exefile = $name . '.exe';
        $logfile = $name . '.txt';

        Storage::put('codes/'.$codefile, $request->code);

        $outputGcc = shell_exec('gcc '.escapeshellarg(storage_path('app/codes/'.$codefile))
                .' -o '.escapeshellarg(storage_path('app/codes/progs/'.$exefile)).' 2>&1');

        if ($outputGcc !== NULL) {
            $termOut = $outputGcc;
        } else {
            $descriptorspec = [
                ['pipe', 'r'],
                ['pipe', 'w'],
                ['file', 'logs/'.$errorfile, 'a']
            ];

            foreach ($requst->testCases as $testCase) {
                $stdin = $testCase['input'];

                $process = proc_open($exefile, $descriptorspec, $pipes, storage_path('app/progs'));

                if (is_resource($process)) {
                    fwrite ($pipes[0], $stdin);
                    fclose ($pipes[0]);

                    $output = stream_get_contents($pipes[1]);
                    fclose ($pipes[1]);

                    $returnValue = proc_close($process);

                    if (!$returnValue) {
                        $termOut = file_get_contents('logs/'.$errorfile);
                    }
                }
            }

            Storage::delete('progs/'.$exefile);
            Storage::delete('logs/'.$errorfile);
        }

        Storage::delete($codefile);

        return response()->json([
            'termOut' => $termOut,
            'testCaseOut' => ''
        ]);
    }
}
