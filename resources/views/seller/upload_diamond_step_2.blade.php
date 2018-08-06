@extends('layouts.app')
@section('content')
    <div id="upload-multi-images">
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-12 col-xs-12">
                <div class="sidebar-sticky" id="sidebar-one">
                    <div class="sidebar-content">
                        <h2>Post a Diamond</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                        <hr>
                        <ul class="step-list">
                            <li><span>1</span><a href="#">Upload CSV File</a></li>
                            <li class="active-step"><span>2</span><a href="#">Upload Images</a></li>
                            <li><span>3</span><a href="#">Upload PDF</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12 col-xs-12">
				<form method="post" name="uploaddmgimgseller" action="{{URL::to('seller/upload-csv-2')}}"  enctype="multipart/form-data">
					{{csrf_field()}}
                <div class="page-content">
                    <div class="container-fluid">
                        <div id="page-right-content">
                            <div class="upload-block images-upload">
                                <h1>Upload Images</h1>
                                <p>Images must have the same name as referred in the .csv file you just uploaded.<br>
                                    Failing to do so will require you upload them manually one diamond at a time.</p>
                                <div class="upload-box {{ $errors->has('upload_dmgimg_seller') ? ' has-error' : '' }}">
                                    <h2 class="text-uppercase">Upload your image files</h2>
                                    <div class="input-group file-btn">
                                        <div class="custom-file">
                                            <input class="custom-file-input" id="browse" type="file" name="upload_dmgimg_seller[]" multiple="multiple" accept="image/jpeg">
                                            <label class="custom-file-label" for="browse">Browse</label>
                                        </div>
                                    </div>
                              @if($errors->has('upload_dmgimg_seller'))
                            <span class="help-block">
                                <strong>{{$errors->first('upload_dmgimg_seller')}}</strong>
                            </span>
                        @endif
                                </div>
                                <div class="btn-bottom-sticky">
                                    <a href="#" class="btn btn-inverse">Previous Step</a>
                                    <input type="submit" name="submit" id="btnstep-1" value="Next step" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
