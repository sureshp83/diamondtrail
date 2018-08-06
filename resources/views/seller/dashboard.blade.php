@extends('layouts.app')
@section('title','Dashboard')
@section('content')
    <div class="page-content">
        <div class="container">
            <div id="dashboard">
                <div class="table-box">
                    <div class="table-header">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 vertically-center">
                                <p class="text-capitalize">Latest Diamond Requests</p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 text-sm-right vertically-center">
                                <a class="btn btn-inverse" href="#">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-content">
                        <table class="table table-hover table-responsive-xs table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Date Requested</th>
                                <th scope="col">Request ID</th>
                                <th scope="col">Origin</th>
                                <th scope="col">Shape</th>
                                <th scope="col">Carat</th>
                                <th scope="col">Clarity</th>
                                <th scope="col">Colour</th>
                                <th scope="col">Cut</th>
                                <th scope="col">Fluo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latest_request as $lreq)
                                <tr>
                                    <td>{{$lreq['created_at']}}</td>
                                    <td>{{$lreq['id']}}</td>
                                    <td>{{$lreq['origin']}}</td>
                                    <td>{{$lreq['shape_label']}}</td>
                                    <td>{{$lreq['carat_min']}}  -  {{$lreq['carat_max']}}</td>
                                    <td>{{$lreq['clarity_type_label']}}</td>
                                    <td>{{(($lreq['intensity_id']==null)?$lreq['color_label'] : $lreq['color_id'])}}</td>
                                    <td>{{$lreq['cut_type_label']}}</td>
                                    <td>{{$lreq['florescence_type_label']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="table-box">
                    <div class="table-header">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 vertically-center">
                                <p class="text-capitalize">My Latest Posts</p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 text-sm-right vertically-center">
                                <a class="btn btn-inverse" href="#">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-content">
                        <table class="table table-hover table-responsive-xs table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">ID</th>
                                <th scope="col">Origin</th>
                                <th scope="col">Shape</th>
                                <th scope="col">Carat</th>
                                <th scope="col">Clarity</th>
                                <th scope="col">Colour</th>
                                <th scope="col">Cut</th>
                                <th scope="col">Fluo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latest_posts as $lpost)
                                <tr>
                                    <td>{{$lpost['created_at']}}</td>
                                    <td>{{$lpost['id']}}</td>
                                    <td>{{$lpost['origin']}}</td>
                                    <td>{{$lpost['shape_label']}}</td>
                                    <td>{{$lpost['carat']}}</td>
                                    <td>{{$lpost['clarity_type_label']}}</td>
                                    <td>{{(($lpost['intensity_id']==null)?$lpost['color_label'] : $lpost['color_id'])}}</td>
                                    <td>{{$lpost['cut_type_label']}}</td>
                                    <td>{{$lpost['florescence_type_label']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection