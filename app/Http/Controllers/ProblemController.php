<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $problems = Problem::all();

        return view('problem.index', [
            'problems' => $problems,
        ]);
    }

    public function show($id)
    {
        $problem = Problem::find($id);

        return view('problem.show', [
            'problem' => $problem,
        ]);
    }

    public function solve($id)
    {
        $problem = Problem::find($id);

        return view('devenv.index', [
            'problem' => $problem,
        ]);
    }
}
