<?php

namespace App\Http\Controllers;

use Storage;
use App\Problem;
use Illuminate\Http\Request;

class DevEnvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'show'
        ]]);
    }

    public function show()
    {
        return view('devenv.index');
    }

    public function test(Request $request, $id)
    {
        $problem = Problem::find($id);

        $req = $request->all();

        $req['testCases'][] = [
            'input' => $problem->input,
            'output' => $problem->output,
        ];

        $response = $this->run((object)$req);

        $response['solved'] = false;
        if (end($response['testCaseOut'])) {
            $response['solved'] = true;

            $request->user()->xp += $problem->xp;
            $request->user()->save();
        }

        array_pop($response['testCaseOut']);

        return response()->json($response);
    }

    public function compile(Request $request)
    {
        return response()->json($this->run($request));
    }

    private function run($request)
    {
        $terminalOut = '';
        $testCaseOut = '';

        $name = uniqid();

        if ($request->lang === 'C') {
            $codefile = $name . '.c';
        } else if ($request->lang === 'C++') {
            $codefile = $name . '.cpp';
        }

        $exefile = $name . '.out';
        $logfile = $name . '.txt';

        Storage::put('codes/'.$codefile, $request->code);

        if ($request->lang === 'C') {
            $outputGcc = shell_exec('gcc '.escapeshellarg(storage_path('app/codes/'.$codefile))
                    .' -o '.escapeshellarg(storage_path('app/codes/progs/'.$exefile)).' 2>&1');
        } else if ($request->lang === 'C++') {
            $outputGcc = shell_exec('g++ '.escapeshellarg(storage_path('app/codes/'.$codefile))
                    .' -o '.escapeshellarg(storage_path('app/codes/progs/'.$exefile)).' 2>&1');
        }

        if ($outputGcc !== NULL) {
            $terminalOut = $outputGcc;
        } else {
            if (count($request->testCases) == 0) {
                $outputExe = shell_exec('('.storage_path('app/codes/progs/'.$exefile).' 2>&1)');

                $terminalOut = $outputExe;
            } else {
                $descriptorspec = [
                    ['pipe', 'r'],
                    ['pipe', 'w'],
                    ['file', storage_path('app/codes/logs/'.$logfile), 'a']
                ];

                foreach ($request->testCases as $testCase) {
                    $stdin = $testCase['input'];

                    if ($request->lang === 'C' || $request->lang === 'C++') {
                        $process = proc_open('./'.$exefile, $descriptorspec, $pipes, storage_path('app/codes/progs'));
                    } else if ($request->lang === 'Java') {
                        $process = proc_open('java '.$exefile, $descriptorspec, $pipes, storage_path('app/codes/progs'));
                    }

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

        return [
            'terminalOut' => $terminalOut,
            'testCaseOut' => $testCaseOut
        ];
    }
}
