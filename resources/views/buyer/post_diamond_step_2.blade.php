@extends('layouts.app')
@section('title','Request diamond')
@section('content')
    <div id="post-a-diamond-review">
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-12 col-xs-12">
                <div class="sidebar-sticky" id="sidebar-one">
                    <div class="sidebar-content">
                        <h2>Post a Diamond</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>

                        <hr>
                        <ul class="step-list">
                            <li><span><i class="fa fa-check"></i></span><a href="#">Diamond Details</a></li>
                            <li class="active-step"><span>2</span><a href="#">Review</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 col-md-12 col-xs-12">
                <form method="post" name="pdiamond-step2" id="pdiamond-step2" action="{{URL::to("/buyer/pdiamond-step2/")}}/{{$diamond_detail['id']}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                <div class="page-content">
                    <div class="container-fluid">
                        <div id="page-right-content">
                            <a href="{{URL::to('buyer/pdiamond-step1/')}}/{{$diamond_detail['id']}}" class="btn btn-inverse float-sm-right top-edit-button hide-in-mobile">Edit</a>
                            <div class="clearfix"></div>
                            <div class="origin-box">
                                <h2>Origin</h2>
                                <div class="row">
                                    <?php $expload=explode(',',$diamond_detail['origin']);
                                    foreach ($expload as $value){
                                        $origin[]=explode('-',$value);
                                    }
                                    $org['country_id']=array_column($origin,0);
                                    $org['producer_id']=array_column($origin,1);
                                    $org['mine_id']=array_column($origin,2);

                                    ?>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Country of Origin</label>
                                            <p>{{implode(',',$org['country_id'])}}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Producer</label>
                                            <p>{{implode(',',$org['producer_id'])}}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Mine of Origin</label>
                                            <p>{{implode(',',$org['mine_id'])}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--<div class="price-box">
                                <h2>Price</h2>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Price/Carat($)</label>
                                            <p>{{number_format($diamond_detail['price'])}}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Total Price ($)</label>
                                            <p>{{number_format($diamond_detail['totalprice'])}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}

                            <div class="diamond_details">
                                <h2>Diamond Details</h2>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Shape</label>
                                            <p>{{$diamond_detail['shape_label']}}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12 carat">
                                        <div class="form-group">
                                            <label class="control-label">Carat</label>
                                            <p>{{$diamond_detail['carat_min']}} - {{$diamond_detail['carat_max']}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-5 col-xs-12 range-filter">
                                        <div class="form-group">
                                            <label class="control-label">Clarity</label>
                                            <p>{{$diamond_detail['clarity_type_label']}}</p>
                                        </div>
                                    </div>
                                {{--</div>--}}

                                {{--<div class="row">--}}
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12 colour">
                                        <div class="form-group">
                                            <label class="control-label"> Colour</label>
                                            <p>{{$diamond_detail['color_label']}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12 cut">
                                        <div class="form-group">
                                            <label class="control-label">Cut</label>
                                            <p>{{$diamond_detail['cut_type_label']}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12 fluorescence">
                                        <div class="form-group">
                                            <label class="control-label">Fluorescence</label>
                                            <p>{{$diamond_detail['florescence_type_label']}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="brand-box">
                                <h2>Brand</h2>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <p>{{$diamond_detail['brand_label']}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="certification-box">
                                <h2>Certification</h2>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Certification Laboratory</label>
                                            <p>{{$diamond_detail['certification_laboratory_label']}}</p>
                                        </div>
                                    </div>
                                    {{--<div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Certificate Number</label>
                                            <p>{{$diamond_detail['certification_number']}}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label btn-block">Diamond Certificate</label>
                                            <p>{{$diamond_detail['diamond_certi_file']}}</p>
                                        </div>
                                    </div>--}}
                                </div>
                            </div>

                            <div class="images-box">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-xs-12">
                                        <h2>Comment<span></span></h2>
                                        <div class="form-group">
                                           <p>{{$diamond_detail['comments']}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer-buttons text-sm-right">
                                <a href="{{URL::to('buyer/dashboard/')}}" class="float-sm-left cancel-button"><input type="button" name="cancel" value="cancel" class="btn btn-primary btn-inverse">&nbsp;&nbsp;</a>
                                <a href="{{URL::to('buyer/pdiamond-step1/')}}/{{$diamond_detail['id']}}"><input type="button" name="edit" value="Edit" class="btn btn-primary btn-inverse">&nbsp;&nbsp;</a>
                                <input type="button" name="postdiamond" value="Add my request" class="btn btn-primary">
                            </div>

                        </div>
                    </div>
                </div>
        </form>
            </div>

        </div>
    </div>
    <div id="custom-alert-box">
        <div class="alert-box text-sm-center">
            <h3>Are you sure <br>
                you want to add your request?</h3>
            <a href="javascript:void(0);" onclick="closeAlert()" class="btn btn-inverse">CANCLE</a>
            <a href="javascript:void(0);" class="btn btn-primary postDiamond">ADD MY REQUEST</a>
        </div>
    </div>
@endsection