@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>{{ Auth::user()->name }}</h1>
            <h2>XP: {{ Auth::user()->xp }}</h2>

            <a href="{{ route('problem.index') }}" class="btn btn-primary">Solve Problems</a>
        </div>
    </div>
</div>
@endsection
