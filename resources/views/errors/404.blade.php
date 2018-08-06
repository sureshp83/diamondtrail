@extends('layouts.app')
@section('title','404 Page')
@section('content')
    <div class="container-fluid">
        <div id="page-not-found">
            <div class="not-found-content">
                <h1>4<img src="{{URL::to('images/icon-404.png')}}" title="404" alt="404">4</h1>
                <h2>The page you were looking for doesn’t exist!</h2>
                <a href="{{url::to('seller/dashboard')}}" class="btn btn-primary">Back to dashboard</a>
            </div>
        </div>
    </div>
@endsection