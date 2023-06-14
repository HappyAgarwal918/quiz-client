@extends('layouts.client')
@section('css')
<style type="text/css">
    .wrong{
        color: red;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Results of your test</div>
                <div class="card-body">
                    <p><strong>Total points:</strong> {{ $result->total_points }} points</p>
                    <a href="{{ route('client.test') }}" class="btn btn-primary">Start test again</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection