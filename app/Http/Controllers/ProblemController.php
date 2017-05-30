<?php

namespace App\Http\Controllers;

use App\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'index', 'show'
        ]]);
    }

    public function index()
    {
        $problems = Problem::all();

        return view('problem.index', [
            'problems' => $problems,
        ]);
    }

    public function create()
    {
        return view('problem.create');
    }

    public function store(Request $request)
    {
        $problem = Problem::create([
            'title' => $request->title,
            'body' => $request->body,
            'xp' => $request->xp
        ]);

        return redirect()->route('problem.show', [$problem]);
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
