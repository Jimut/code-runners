@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form method="POST" action="{{ route('problem.store') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Body</label>
                    <input type="text" name="body" class="form-control">
                </div>
                <div class="form-group">
                    <label>XP</label>
                    <input type="text" name="xp" class="form-control">
                </div>

                <hr>

                <div class="form-group">
                    <label>Input</label>
                    <input type="text" name="input" class="form-control">
                </div>
                <div class="form-group">
                    <label>Ouput</label>
                    <input type="text" name="output" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

@endsection
