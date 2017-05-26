@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>{{ $problem->title }}</h1>
            <p>{{ $problem->body }}</p>

            <a href="{{ route('problem.solve', [$problem]) }}" class="btn btn-primary">Solve</a>
        </div>
    </div>
</div>

@endsection
