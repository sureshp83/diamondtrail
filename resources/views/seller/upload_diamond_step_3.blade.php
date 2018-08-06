@extends('layouts.app')
@section('content')
    <div id="upload-pdf">
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-12 col-xs-12">
                <div class="sidebar-sticky" id="sidebar-one">
                    <div class="sidebar-content">
                        <h2>Post a Diamond</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                        <hr>
                        <ul class="step-list">
                            <li><span>1</span><a href="#">Upload CSV File</a></li>
                            <li><span>2</span><a href="#">Upload Images</a></li>
                            <li class="active-step"><span>3</span><a href="#">Upload PDF</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12 col-xs-12">
				<form method="post" name="uploaddmgpdfseller" action="{{URL::to('seller/upload-csv-3')}}"  enctype="multipart/form-data">
					{{csrf_field()}}
                <div class="page-content">
                    <div class="container-fluid">
                        <div id="page-right-content">
                            <div class="upload-block pdf-upload">
                                <h1>Upload PDF</h1>
                                <p>PDFs must have the same name as referred in the .csv file you just uploaded.<br>
                                    Failing to do so will require you upload them manually one diamond at a time.</p>
                                <div class="upload-box {{ $errors->has('upload_dmgpdf_seller') ? ' has-error' : '' }}">
                                    <h2 class="text-uppercase">Upload your .PDF files</h2>
                                    <div class="input-group file-btn">
                                        <div class="custom-file">
                                            <input class="custom-file-input" id="browse" type="file" name="upload_dmgpdf_seller[]" multiple="multiple" accept="application/pdf, application/vnd.ms-excel">
                                            <label class="custom-file-label" for="browse">Browse</label>
                                        </div>
                                    </div>
                                    @if($errors->has('upload_dmgpdf_seller'))
                            <span class="help-block">
                                <strong>{{$errors->first('upload_dmgpdf_seller')}}</strong>
                            </span>
                        @endif
                                </div>
                                <div class="btn-bottom-sticky">
                                    <a href="#" class="btn btn-inverse">Previous Step</a>
                                    <input type="button" name="postdiamond" id="btnstep-3" value="Post my diamonds" class="btn btn-primary">
                                </div>


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
                you want to post diamonds?</h3>
            <a href="javascript:void(0);" onclick="closeAlert()" class="btn btn-inverse">Cancel</a>
            <a href="javascript:void(0);" class="btn btn-primary postDiamond">Post My Diamonds</a>
        </div>
    </div>
    <script>
    $("#btnstep-3").on("click",function(){
        $('#custom-alert-box').show();
            setTimeout(function () {
                $('#custom-alert-box .alert-box').addClass('show-alert');
            }, 100);    
    });
    
    </script>
@endsection
