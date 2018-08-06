@extends('layouts.app')
@section('content')
    <div id="upload-csv">
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-12 col-xs-12">
                <div class="sidebar-sticky" id="sidebar-one">
                    <div class="sidebar-content">
                        <h2>Post a Diamond</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>
                        <hr>
                        <ul class="step-list tab">
                         {{--   <li><span>1</span><a href="#" class="tablinks" onclick="openTab(event, 'upload_csv')" id="defaultOpen">Upload CSV File</a></li>
                            <li><span>2</span><a href="#" class="tablinks" onclick="openTab(event, 'upload_images')">Upload Images</a></li>
                            <li><span>3</span><a href="#" class="tablinks" onclick="openTab(event, 'upload_pdf')">Upload PDF</a></li>--}}
                            <li><span>1</span><a href="#" class="tablinks"  onclick="openTab(event, 'upload_csv')"  id="defaultOpen">Upload CSV File</a></li>
                            <li><span>2</span><a href="#" class="tablinks" >Upload Images</a></li>
                            <li><span>3</span><a href="#" class="tablinks" >Upload PDF</a></li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12 col-xs-12 ">
                <form method="post" id="uploadcsvseller" name="uploadcsvseller" action="{{URL::to('seller/upload-csv-1')}}"  enctype="multipart/form-data">
                    <div id="upload_csv" class="tabcontent">

                        {{csrf_field()}}
                        <div class="page-content">
                            <div class="container-fluid">
                                <div id="page-right-content">
                                    <div class="upload-block csv-upload">
                                        <h1>Upload CSV File</h1>
                                        <p>Description lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                                        <a href="{{URL::to('uploads/diamond_csv/sample.csv')}}" class="btn btn-inverse" download >Download the template</a>
                                        <div class="upload-box {{ $errors->has('upload_csv_seller') ? ' has-error' : '' }}">
                                            <h2 class="text-uppercase">Upload the filled template
                                                in .CSV format</h2>
                                            <div class="input-group file-btn">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="upload_csv_seller" type="file" name="upload_csv_seller" accept=".csv">
                                                    <label class="custom-file-label" for="upload_csv_seller">Browse</label>
                                                </div>
                                            </div>
                                            @if($errors->has('upload_csv_seller'))
                                                <span class="help-block">
                                <strong>{{$errors->first('upload_csv_seller')}}</strong>
                            </span>
                                            @endif
                                        </div>
                                        <div class="btn-bottom-sticky">
                                            <input type="button" id="csv_upload_btn" value="Next step" class="btn btn-primary" onclick="openTab(event, 'upload_images')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </form>-->
                    </div>
                    <div id="upload_images" class="tabcontent">
                    <!--          <form method="post" id="uploaddmgimgseller" name="uploaddmgimgseller" action="{{URL::to('seller/upload-csv-2')}}"  enctype="multipart/form-data">-->
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
                                                    <input class="custom-file-input" id="upload_dmgimg_seller" type="file" name="upload_dmgimg_seller[]" multiple="multiple" accept="image/jpeg,.jpeg,.jpg">
                                                    <label class="custom-file-label" for="upload_dmgimg_seller">Browse</label>
                                                </div>
                                            </div>
                                            @if($errors->has('upload_dmgimg_seller'))
                                                <span class="help-block">
                                <strong>{{$errors->first('upload_dmgimg_seller')}}</strong>
                            </span>
                                            @endif
                                        </div>
                                        {{--<input class="custom-file-input" id="browse" type="file" name="upload_dmgimg_seller[]" multiple="multiple" accept="image/x-png,image/gif,image/jpeg">--}}
                                        <div class="btn-bottom-sticky">
                                            <a href="#" id="img_upload_btn_prev" class="btn btn-inverse" onclick="openTab(event, 'upload_csv')">Previous Step</a>
                                            <input type="button" id="img_upload_btn" value="Next step" class="btn btn-primary" onclick="openTab(event, 'upload_pdf')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </form>-->
                    </div>
                    <div id="upload_pdf" class="tabcontent">
                    <!-- <form method="post" id="uploaddmgpdfseller" name="uploaddmgpdfseller" action="{{URL::to('seller/upload-csv-3')}}"  enctype="multipart/form-data">-->
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
                                                    <input class="custom-file-input" id="browse" type="file" name="upload_dmgpdf_seller[]" multiple="multiple" accept="application/pdf, application/vnd.ms-excel,.pdf,.xls,.xlsx">
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
                                            <a href="#" id="cert_upload_btn_prev" class="btn btn-inverse" onclick="openTab(event, 'upload_images')">Previous Step</a>
                                            <input type="button" id="cert_upload_btn" name="postdiamond" value="Post my diamonds" class="btn btn-primary">
                                        </div>
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
            <a href="javascript:void(0);" class="btn btn-primary" onclick="submitForms()">Post My Diamonds</a>
        </div>
    </div>
    <script>
        $("#btnstep-3").on("click",function(){
            $('#custom-alert-box').show();
            setTimeout(function () {
                $('#custom-alert-box .alert-box').addClass('show-alert');
            }, 100);
        });

        function openTab(evt, tabName) {
            $('#csv_upload_btn').prop('disabled', false);
            $('#img_upload_btn').prop('disabled', false);
            $('#cert_upload_btn').prop('disabled', false);
           
            if($('#upload_csv_seller').val() == ''){
                $('#csv_upload_btn').prop('disabled', true);
            }
            if($('#upload_dmgimg_seller').val() == ''){
                $('#img_upload_btn').prop('disabled', true);
            } if($('#browse').val() == ''){
                $('#cert_upload_btn').prop('disabled', true);
            }


            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].parentNode.className = tablinks[i].parentNode.className.replace("active-step", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.parentNode.className += " active-step";

            if(evt.currentTarget.id == 'csv_upload_btn'){
                $('.step-list li:nth-child(1)').removeClass('active-step');
                $('.step-list li:nth-child(2)').addClass('active-step');
            }else if(evt.currentTarget.id == 'img_upload_btn'){
                $('.step-list li:nth-child(2)').removeClass('active-step');
                $('.step-list li:nth-child(3)').addClass('active-step');
            }else if(evt.currentTarget.id == 'cert_upload_btn_prev'){
                $('.step-list li:nth-child(3)').removeClass('active-step');
                $('.step-list li:nth-child(2)').addClass('active-step');
            }else if(evt.currentTarget.id == 'img_upload_btn_prev'){
                $('.step-list li:nth-child(2)').removeClass('active-step');
                $('.step-list li:nth-child(1)').addClass('active-step');
            }

        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();

        $('#upload_csv_seller').on('change', function(){
            $('#csv_upload_btn').prop('disabled', false);
            if($('#upload_csv_seller').val() == ''){
                $('#csv_upload_btn').prop('disabled', true);
            }
        });

        $('#upload_dmgimg_seller').on('change', function(){
            $('#img_upload_btn').prop('disabled', false);
            if($('#upload_dmgimg_seller').val() == ''){
                $('#img_upload_btn').prop('disabled', true);
            }
        });

        $('#browse').on('change', function(){
            $('#cert_upload_btn').prop('disabled', false);
            if($('#browse').val() == ''){
                $('#cert_upload_btn').prop('disabled', true);
            }
        });

        function submitForms(){
            $("#uploadcsvseller").submit();
        }
    </script>
@endsection