@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>Problems</h1>
            <p class="lead">Attend these to earn xps</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @foreach ($problems as $problem)
                <h3><a href="{{ route('problem.show', [$problem]) }}">{{ $problem->title }}</a></h3>
                <p>{{ $problem->body }}</p>
                <hr>
            @endforeach
        </div>
    </div>
</div>

@endsection
