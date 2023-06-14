@extends('layouts.client')
@section('css')
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<!-- Styles -->
<style>
    .full-height {
        height: 80vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .title > a {
        color: #636b6f;
        text-decoration: underline;
    }
</style>
@endsection
@section('content')

<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title">
            <a href="{{ route('client.test') }}">START TEST</a>
        </div>
    </div>
</div>
@endsection