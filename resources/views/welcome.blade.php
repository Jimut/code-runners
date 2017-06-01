@extends('layouts.app')

@section('content')
<div class="jumbotron bg-code" style="margin-top: -22px">
    <div class="container">
        <h1>Code Runners</h1>
        <p>The worlds most advanced online competitive coding solution. This is just to fill the space. A simple jumbotron-style component for calling extra attention to featured content or information.</p>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Solve Problems</h2>
            <p>Lumbersexual iPhone tilde succulents palo santo, edison bulb occupy echo park vexillologist art party. Asymmetrical tilde street art iPhone echo park bicycle rights. Four dollar toast pickled hoodie, vape tilde copper mug beard cornhole. Mumblecore.</p>
            <a href="{{ route('problem.index') }}" class="btn btn-primary">Solve Problems</a>
        </div>
        <div class="col-md-6">
            <h2>Earn XPs</h2>
            <p>Lumbersexual iPhone tilde succulents palo santo, edison bulb occupy echo park vexillologist art party. Asymmetrical tilde street art iPhone echo park bicycle rights. Four dollar toast pickled hoodie, vape tilde copper mug beard cornhole. Mumblecore.</p>
            <a href="{{ url('/register') }}" class="btn btn-primary">Register</a>
        </div>
    </div>
</div>
@endsection
