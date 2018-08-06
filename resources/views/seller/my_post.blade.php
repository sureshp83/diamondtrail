@extends('layouts.app')
@section('title','My-post')
@section('content')
    <div id="search-diamond">
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-12 col-xs-12">
                <div class="sidebar-sticky" id="sidebar-two">
                    <div class="sidebar-filters">
                        <ul class="filter-list">
                            <li id="shapeFilter">
                                <a class="btn btn-link" href="#">Shape <i class="fas fa-chevron-right"></i></a>
                                <ul>
                                    @foreach($shapes as $shap)
                                        <li>
                                            <input class="form-control radio-input" id="{{$shap->label}}" name="shapefilter[]" type="checkbox" value="{{$shap->id}}">
                                            <label class="radio-btn" for="{{$shap->label}}">{{$shap->label}}</label>
                                            <figure>
                                                <img src="{{asset('images/')}}/{{$shap->img}}" alt="{{$shap->label}}" title="{{$shap->label}}">
                                            </figure>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a class="btn btn-link" data-toggle="collapse" href="#Carat" role="button" aria-expanded="false" aria-controls="Carat">Carat <i class="fas fa-chevron-down"></i></a>
                                <div class="collapse" id="Carat">
                                    <div class="card card-body">
                                        <div class="filter-content">
                                            <div class="row">
                                            <span class="error-carat"></span>
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="text-capitalize">min.</label>
                                                        <input type="text" class="form-control" name="carat_min" id="carat_min" placeholder="0,00">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-52 col-xs-12 vertically-center"><i class="fas fa-minus fa-2x"></i></div>
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <label class="text-capitalize">max.</label>
                                                    <input type="text" class="form-control" name="carat_max" id="carat_max" placeholder="0,00">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn btn-link" data-toggle="collapse" href="#Clarity" role="button" aria-expanded="false" aria-controls="Clarity">Clarity <i class="fas fa-chevron-down"></i></a>
                                <div class="collapse" id="Clarity">
                                    <div class="card card-body">
                                        <div class="filter-content">
                                            <div class="row">
                                            <span class="error-clarity"></span>
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <div class="form-group">
                                                        <select name="clarity_type_start" id="clarity_type_start" class="form-control">
                                                          <option value="">select</option>
                                                            @foreach($clarity_types as $cl_type)
                                                                <option value="{{$cl_type->id}}" >{{$cl_type->label}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-52 col-xs-12 vertically-center"><i class="fas fa-minus fa-2x"></i></div>
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <select name="clarity_type_end" id="clarity_type_end" class="form-control">
                                                    <option value="">select</option>
                                                        @foreach($clarity_types as $cl_type)
                                                            <option value="{{$cl_type->id}}" >{{$cl_type->label}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn btn-link" data-toggle="collapse" href="#Colour" role="button" aria-expanded="false" aria-controls="Colour">Colour <i class="fas fa-chevron-down"></i></a>
                                <div class="collapse" id="Colour">
                                    <div class="card card-body">
                                        <div class="filter-content">
                                            <div class="row">
                                            <span class="error-colour"></span>
                                                <div class="col-lg-6 col-md-6 col-xs-12">
                                                    <div class="form-group">
                                                    <label>Colourless</label>
                                                        <select name="colorless_id" id="colorless_id" class="form-control">
                                                         <option value="">select</option>
                                                            @foreach($colorless as $color)
                                                                <option value="{{$color->id}}" >{{$color->label}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xs-12">
                                                    <div class="form-group">
                                                    <label>Fancy Colour</label>
                                                        <select name="fancycolor_id" id="fancycolor_id" 
                                                        class="form-control">
                                                        <option value="">select</option>
                                                            @foreach($fancycolor as $fcolor)
                                                                <option value="{{$fcolor->id}}" >{{$fcolor->label}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn btn-link" data-toggle="collapse" href="#Cut" role="button" aria-expanded="false" aria-controls="Cut">Cut <i class="fas fa-chevron-down"></i></a>
                                <div class="collapse" id="Cut">
                                    <div class="card card-body">
                                        <div class="filter-content">
                                            <div class="row">
                                            <span class="error-cut"></span>
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <div class="form-group">
                                                        <select name="cut_type_start" id="cut_type_start" class="form-control">
                                                        <option value="">select</option>
                                                            @foreach($cut_types as $cut_type)
                                                                <option value="{{$cut_type->id}}" >{{$cut_type->label}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-52 col-xs-12 vertically-center"><i class="fas fa-minus fa-2x"></i></div>
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <select name="cut_type_end" id="cut_type_end" class="form-control">
                                                    <option value="">select</option>
                                                        @foreach($cut_types as $cut_type)
                                                            <option value="{{$cut_type->id}}" >{{$cut_type->label}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn btn-link" data-toggle="collapse" href="#Fluorescence" role="button" aria-expanded="false" aria-controls="Fluorescence">Fluorescence <i class="fas fa-chevron-down"></i></a>
                                <div class="collapse" id="Fluorescence">
                                    <div class="card card-body">
                                        <div class="filter-content">
                                            <div class="row">
                                            <span class="error-fluorance"></span>
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <div class="form-group">
                                                        <select name="florescence_type_start" id="florescence_type_start" class="form-control">
                                                        <option value="">select</option>
                                                            @foreach($florescence_types as $fl_type)
                                                                <option value="{{$fl_type->id}}" >{{$fl_type->label}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-52 col-xs-12 vertically-center"><i class="fas fa-minus fa-2x"></i></div>
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <select name="florescence_type_end" id="florescence_type_end" class="form-control">
                                                    <option value="">select</option>
                                                        @foreach($florescence_types as $fl_type)
                                                            <option value="{{$fl_type->id}}" >{{$fl_type->label}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn btn-link" data-toggle="collapse" href="#Price_Carat" role="button" aria-expanded="false" aria-controls="Price_Carat">Price/Carat ($) <i class="fas fa-chevron-down"></i></a>
                                <div class="collapse" id="Price_Carat">
                                    <div class="card card-body">
                                        <div class="filter-content">
                                            <div class="row">
                                            <span class="error-price"></span>
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="text-capitalize">min.</label>
                                                        <input type="text" name="min_price" id="min_price" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-52 col-xs-12 vertically-center"><i class="fas fa-minus fa-2x"></i></div>
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <label class="text-capitalize">max.</label>
                                                    <input type="text" name="max_price" id="max_price" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn btn-link" data-toggle="collapse" href="#Total_Price" role="button" aria-expanded="false" aria-controls="Total_Price">Total Price ($) <i class="fas fa-chevron-down"></i></a>
                                <div class="collapse" id="Total_Price">
                                    <div class="card card-body">
                                        <div class="filter-content">
                                            <div class="row">
                                            <span class="error-totalprice"></span>
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="text-capitalize">min.</label>
                                                        <input type="text" name="total_min_price" id="total_min_price" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-52 col-xs-12 vertically-center"><i class="fas fa-minus fa-2x"></i></div>
                                                <div class="col-lg-5 col-md-5 col-xs-12">
                                                    <label class="text-capitalize">max.</label>
                                                    <input type="text" name="total_max_price" id="total_max_price" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn btn-link" data-toggle="collapse" href="#Search_by_ID" role="button" aria-expanded="false" aria-controls="Search_by_ID">Search by ID <i class="fas fa-chevron-down"></i></a>
                                <div class="collapse" id="Search_by_ID">
                                    <div class="card card-body">
                                        <div class="filter-content">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-5 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="text-capitalize">Id.</label>
                                                        <input type="text" name="request_id" id="request_id" class="form-control" placeholder="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <a href="{{URL::to('/seller/all-post')}}" class="btn btn-inverse"><img src="{{asset('images/icon-reset.png')}}" alt="Reset" title="Reset" width="16px">&nbsp;&nbsp; Reset Filters</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12 col-xs-12">
                <div class="page-content">
                    <div class="container-fluid">
                        <div id="page-right-content" class="filter-box">

                            <!--Date Picker-->
                            <div class="date-picker-box">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-xs-12">
                                        <div class="date-box form-group">
                                            <input type="text" class="form-control datepicker"  name="start_date" id="start_date">
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-12 vertically-center">
                                        <div class="form-group">
                                            <p class="text-uppercase text-sm-center">to</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-xs-12">
                                        <div class="date-box form-group">
                                            <input type="text" class="form-control datepicker" name="end_date" id="end_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Date Picker-->

                            <!-- <p class="total-found text-sm-right">{{count($mypost)}} Diamonds Found</p> -->
                            <div class="filter-header">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12 vertically-center text-sm-center">
                                        <a class="btn btn-primary" href="#" id="compareselect" >Compare Selected</a>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Country of Origin</label>
                                            <select name="country_id" id="country_id" class="form-control">
                                                <option value="">Select</option>
                                                {{--<option value="ALL">All</option>--}}
                                                <option value="BOT">BOT</option>
                                                <option value="CAN">CAN</option>
                                                <option value="LES">LES</option>
                                                <option value="BRAZ">BRAZ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Producer</label>
                                            <select name="producer_id" id="producer_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach($producers as $prod)
                                                    <option value="{{$prod->name}}">{{$prod->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Mine of Origin</label>
                                            <select name="mine_id" id="mine_id" class="form-control">
                                                <option value="">Select</option>
                                                @foreach($mines as $mine)
                                                    <option value="{{$mine->name}}">{{$mine->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filtered-data">
                                <div class="table-box">
                                    <div class="table-content">
                                        <table class="table table-hover table-responsive-xs table-striped" id="myTable">
                                            <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">Date</th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Origin</th>
                                                <th scope="col">Shape</th>
                                                <th scope="col">Carat</th>
                                                <th scope="col">Clarity</th>
                                                <th scope="col">Colour</th>
                                                <th scope="col">Cut</th>
                                                <th scope="col">Fluo</th>
                                                <th scope="col">Price/Carat ($) </th>
                                                <th scope="col">Total Price ($) </th>
                                            </tr>
                                            </thead>
                                            <tbody id="mytabletbody">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="footer-buttons">
                                @if(Request::Segment(2)!="archived-post")
                                <a class="btn btn-inverse" href="javascript:void(0);" onclick="archiveItem()">Archive Item</a>
                                @endif
                                <a class="btn btn-link" href="javascript:void(0);" onclick="showpopup('multi')">Delete Item</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Compare Diamonds MODEL START-->
    <div class="custom-big-modal">
        <!-- Modal -->
        <div class="modal fade" id="compare_diamonds" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="big-modal-header">
                        <button type="button" class="close hide-in-mobile" data-dismiss="modal" aria-label="Close">
                            back to top&nbsp;&nbsp;&nbsp;<span aria-hidden="true"><img src="{{asset('images/btn-close-grey.png')}}" alt="close" title="close"></span>
                        </button>
                        <button type="button" class="close hide-in-desktop" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>&nbsp;&nbsp; Close
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="big-modal-content">
                            <h2>Compare Diamonds</h2>
                            <div class="table-box-two">
                                <table class="table table-striped table-responsive-xs table-hover">
                                    <thead id="comparethead">
                                    </thead>
                                    <tbody id="comptable">

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--REASERACH SLIDER MODEL START-->
    <div class="custom-big-modal">
        <!-- Modal -->
        <div class="modal fade" id="research_slider" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="big-modal-header">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 header-section-left leftheader">
                                <div class="box-one">
                                    <img id="mainimage" src="{{asset('images/icon-diamond-finger-print.png')}}" alt="Finger print" title="Finger print">
                                    <p id="maincarat"> </p>
                                    <p id="mainshape"> </p>
                                </div>
                                <div class="box-two">
                                    <div class="part-one">
                                        <span>Price/Carat ($)</span>
                                        <p id="mainprice"></p>
                                    </div>
                                    <div class="part-two">
                                        <span>Total Price ($)</span>
                                        <p id="maintotalprice"></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 header-section-right vertically-center rightheader">
                                <div class="box-three">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <span>Country</span>
                                            <p id="maincountry"></p>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>Mine</span>
                                            <p id="mainmine"></p>
                                        </li>
                                        <li class="list-inline-item">
                                            <span>Producer</span>
                                            <p id="mainproducer"></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="close hide-in-mobile closeresearchmodal"  data-dismiss="modal" aria-label="Close">
                            back to top&nbsp;&nbsp;<span aria-hidden="true"><img src="{{asset('images/popup-close.png')}}" alt="close" title="close"></span>
                        </button>
                        <button type="button" class="close hide-in-desktop" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>&nbsp;&nbsp; Close
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="big-modal-content">
                            <div class="row">
                                <div class="col-lg-6 col-md-5 col-xs-12 vertically-center">
                                    <div class="model-right-content">
                                        <div id="diamond-slider" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                            {{--    <div class="carousel-item active">
                                                    <img class="d-block w-100" src="images/Diamond_big_1.jpg" alt="Diamond">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="images/Diamond_big_1.jpg" alt="Diamond">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="images/Diamond_big_1.jpg" alt="Diamond">
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="d-block w-100" src="images/Diamond_big_1.jpg" alt="Diamond">
                                                </div>--}}
                                            </div>
                                            <ol class="carousel-indicators">
                                                {{--<li data-target="#diamond-slider" data-slide-to="0" class="active"><img class="d-block w-100" src="images/Diamond_thumbnail_1.jpg" alt="Diamond"></li>
                                                <li data-target="#diamond-slider" data-slide-to="1"><img class="d-block w-100" src="images/Diamond_thumbnail_2.jpg" alt="Diamond"></li>
                                                <li data-target="#diamond-slider" data-slide-to="2"><img class="d-block w-100" src="images/Diamond_thumbnail_3.jpg" alt="Diamond"></li>
                                                <li data-target="#diamond-slider" data-slide-to="3"><img class="d-block w-100" src="images/Diamond_thumbnail_4.jpg" alt="Diamond"></li>--}}
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-7 col-xs-12">
                                    <div class="model-left-content">
                                        <!-- <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <span>Company Name</span>
                                                <h2 id="comp_name"></h2>
                                            </li>
                                            <li class="list-inline-item">
                                                <span>Contact Person</span>
                                                <h2 id="username"></h2>
                                            </li>
                                        </ul>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-xs-12 text-sm-center">
                                                <a href="#" class="btn btn-primary">Call Seller</a>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-xs-12 text-sm-center">
                                                <a href="#" class="btn btn-primary">Email Seller</a>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-xs-12 text-sm-center">
                                                <a href="#" class="btn btn-primary">Share details</a>
                                            </div>
                                        </div> -->
                                        <div class="table-box-two">
                                            <table class="table table-striped table-hover">
                                                <tbody id="viewdetailtbody">

                                                </tbody>
                                            </table>
                                            <br>
                                            <a href="#" class="btn btn-inverse float-sm-right download-pdf">
                                                <img src="{{asset('images/icon-print.png')}}" alt="Print" title="Print"> Download as PDF
                                            </a>
                                        </div>
                                        <div class="footer-buttons">
                                        <a class="btn btn-inverse editpostlink" href="">Edit</a>
                                
                                <a class="btn btn-inverse archivebtn" href="javascript:void(0);" onclick="archiveSingleItem()">Archive</a>
                                
                                <a class="btn btn-link" href="javascript:void(0);" onclick="showpopup('single')">Delete</a>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="custom-alert-box">
        <div class="alert-box text-sm-center">
            <h3>Are you sure <br>
                you want to delete diamond?</h3>
            <a href="javascript:void(0);" onclick="closeAlert()" class="btn btn-inverse">CANCEL</a>
            <a href="javascript:void(0);" class="btn btn-primary deleterequest">DELETE DIAMOND</a>
        </div>
    </div>
    <!--REASERACH SLIDER MODEL End-->

    <script>

      var shapeFilter={};
      var caratFilter={};
      var clarityFilter={};
      var colorFilter={};
      var cutFilter={};
      var FluorescenceFilter={};
      var priceFilter={};
      var totalPriceFilter={};
      var requestidFilter={};
      var dateFilter={};
      var dropdownFilter={};

        $("input[type='checkbox'][name='shapefilter[]']").each(function(){
            if($(this).is(':checked')){
                shapeFilter[$(this).val()]=$(this).val();
            }
        });
        caratFilter['carat_min']=$("#carat_min").val();
        caratFilter['carat_max']=$("#carat_max").val();

        //clarityFilter['clarity_type_start']=$("#clarity_type_start").val();
        //clarityFilter['clarity_type_end']=$("#clarity_type_end").val();

        //cutFilter['cut_type_start']=$("#cut_type_start").val();
        //cutFilter['cut_type_end']=$("#cut_type_end").val();

        //FluorescenceFilter['florescence_type_start']=$("#florescence_type_start").val();
        //FluorescenceFilter['florescence_type_end']=$("#florescence_type_end").val();

        priceFilter['min_price']=$("#min_price").val();
        priceFilter['max_price']=$("#max_price").val();

        totalPriceFilter['total_min_price']=$("#total_min_price").val();
        totalPriceFilter['total_max_price']=$("#total_max_price").val();

        dateFilter['start_date']=$("#start_date").val();
        dateFilter['end_date']=$("#end_date").val();

        dropdownFilter['country_id']=$("#country_id").val();
        dropdownFilter['producer_id']=$("#producer_id").val();
        dropdownFilter['mine_id']=$("#mine_id").val();

        var filtersection={'shapeFilter':shapeFilter,
                           'caratFilter':caratFilter,
                           'clarityFilter':clarityFilter,
                           'colorFilter':colorFilter,
                           'cutFilter':cutFilter,
                           'FluorescenceFilter':FluorescenceFilter,
                           'priceFilter':priceFilter,
                           'totalPriceFilter':totalPriceFilter,
                           'requestidFilter':requestidFilter
               };
        var datesection={'dateFilter':dateFilter};
        var dropdownsection={'dropdownFilter':dropdownFilter};


        $("input[type='checkbox'][name='shapefilter[]']").change(function() {
            if($(this).is(':checked')){
                shapeFilter[$(this).val()]=$(this).val();
            }else{
                var key = $(this).val();
                delete shapeFilter[key];
            }

            CalledAjax(filtersection,datesection,dropdownsection);
        });

        $("#carat_min").on("blur",function(){
            $(".error-carat").text('');
            $(".error-carat").removeClass("filter-error");
            caratFilter['carat_min']=$(this).val();
            CalledAjax(filtersection,datesection,dropdownsection);
        });

        $("#carat_max").on("blur",function(){
            if(parseInt($(this).val()) < parseInt($("#carat_min").val())){
                $(".error-carat").text("Please enter greter than min value.");
                $(".error-carat").addClass("filter-error");
            }else{
                $(".error-carat").text('');
                $(".error-carat").removeClass("filter-error");
                caratFilter['carat_max']=$(this).val();
                CalledAjax(filtersection,datesection,dropdownsection);
            }
        });
        $("#clarity_type_start").on('change', function() {
            $(".error-clarity").text("");
            $(".error-clarity").removeClass("filter-error");
            clarityFilter['clarity_type_start']=$(this).val();
            clarityFilter['clarity_type_end']=$("#clarity_type_end").val();
            CalledAjax(filtersection,datesection,dropdownsection);
        })

        $("#clarity_type_end").on("change",function(){
            if(parseInt($(this).val()) < parseInt($("#clarity_type_start").val())){
                $(".error-clarity").text("Please select greter than min value.");
                $(".error-clarity").addClass("filter-error");
            }else{
                $(".error-clarity").text("");
                $(".error-clarity").removeClass("filter-error");
                clarityFilter['clarity_type_end']=$(this).val();
                CalledAjax(filtersection,datesection,dropdownsection);
            }
        });

        $("#cut_type_start").on('change', function() {
            $(".error-cut").text("");
            $(".error-cut").removeClass("filter-error");
            cutFilter['cut_type_start']=$(this).val();
            cutFilter['cut_type_end']=$("#cut_type_end").val();
            CalledAjax(filtersection,datesection,dropdownsection);
        })

        $("#cut_type_end").on("change",function(){
            if(parseInt($(this).val()) < parseInt($("#cut_type_start").val())){
                $(".error-cut").text("Please select greter than min value.");
                $(".error-cut").addClass("filter-error");
            }else{
                $(".error-cut").text("");
                $(".error-cut").removeClass("filter-error");
                cutFilter['cut_type_end']=$(this).val();
                CalledAjax(filtersection,datesection,dropdownsection);
            }
            
        });

        $("#colorless_id").on("change",function(){
            colorFilter['colorless_id']=$(this).val();
            colorFilter['fancycolor_id']=$("#fancycolor_id").val();
            CalledAjax(filtersection,datesection,dropdownsection);
        });

        $("#fancycolor_id").on("change",function(){
            colorFilter['colorless_id']=$("#colorless_id").val();
            colorFilter['fancycolor_id']=$(this).val();
            CalledAjax(filtersection,datesection,dropdownsection);
        });
        
        $("#florescence_type_start").on('change', function() {
            $(".error-fluorance").text("");
            $(".error-fluorance").removeClass("filter-error");
            FluorescenceFilter['florescence_type_start']=$(this).val();
            FluorescenceFilter['florescence_type_end']=$("#florescence_type_end").val();
            CalledAjax(filtersection,datesection,dropdownsection);
        })

        $("#florescence_type_end").on("change",function(){
            if(parseInt($(this).val()) < parseInt($("#florescence_type_start").val())){
                $(".error-fluorance").text("Please select greter than min value.");
                $(".error-fluorance").addClass("filter-error");
            }else{
                $(".error-fluorance").text("");
                $(".error-fluorance").removeClass("filter-error");
                FluorescenceFilter['florescence_type_end']=$(this).val();
                CalledAjax(filtersection,datesection,dropdownsection);        
            }
            
        });

        $("#min_price").on("blur",function(){
            $(".error-price").text("");
            $(".error-price").removeClass("filter-error");
            priceFilter['min_price']=$("#min_price").val();
            CalledAjax(filtersection,datesection,dropdownsection);
        });
        $("#max_price").on("blur",function(){
            if(parseInt($(this).val()) < parseInt($("#min_price").val())){
                $(".error-price").text("Please enter greter than min value.");
                $(".error-price").addClass("filter-error");
            }else{
                $(".error-price").text("");
                $(".error-price").removeClass("filter-error");
                priceFilter['max_price']=$("#max_price").val();
                CalledAjax(filtersection,datesection,dropdownsection);    
            }

            
        });

        $("#total_min_price").on("blur",function(){
            $(".error-totalprice").text("");
            $(".error-totalprice").removeClass("filter-error");
            totalPriceFilter['total_min_price']=$("#total_min_price").val();
            CalledAjax(filtersection,datesection,dropdownsection);
        });

        $("#total_max_price").on("blur",function(){
            if(parseInt($(this).val()) < parseInt($("#total_min_price").val())){
                $(".error-totalprice").text("Please enter greter than min value.");
                $(".error-totalprice").addClass("filter-error");
            }else{
                $(".error-totalprice").text("");
                $(".error-totalprice").removeClass("filter-error");
                totalPriceFilter['total_max_price']=$("#total_max_price").val();
                CalledAjax(filtersection,datesection,dropdownsection);    
            }
            
        });

        $("#request_id").on("blur",function(){
            requestidFilter['request_id']=$("#request_id").val();
            CalledAjax(filtersection,datesection,dropdownsection);
        });

        $("#country_id").on("change",function(){
            dropdownFilter['country_id']=$(this).val();
            CalledAjax(filtersection,datesection,dropdownsection);
        });

        $("#producer_id").on("change",function(){
            dropdownFilter['producer_id']=$(this).val();
            CalledAjax(filtersection,datesection,dropdownsection);
        });
        $("#mine_id").on("change",function(){
            dropdownFilter['mine_id']=$(this).val();
            CalledAjax(filtersection,datesection,dropdownsection);
        });

        $('#start_date').change(function(){
            if($(this).val()!=""){
                dateFilter['start_date']=$(this).val();
                CalledAjax(filtersection,datesection,dropdownsection);
            }
        });

      $('#end_date').change(function(){
          if($(this).val()!=""){
              dateFilter['end_date']=$(this).val();
              CalledAjax(filtersection,datesection,dropdownsection);
          }
      });

      //var table = $('#myTable').DataTable();

      function CalledAjax(filtersection,datesection,dropdownsection){
          if ( $.fn.dataTable.isDataTable( '#myTable' ) ) {
              table.destroy();
          }

          var array={'_token': '{{ csrf_token() }}','record_type':'{{$record_type}}','filtersection':filtersection,'datesection':datesection,'dropdownsection':dropdownsection};
          table = $('#myTable').DataTable({
              searching: false,
              pageLength: 10,
              oLanguage: {
                  oPaginate: {
                      sFirst: "First page",
                      sPrevious: "<",
                      sNext: ">",
                      sLast: "Last page"
                  }
              },
              ajax: {
                  "url":"{{URL::to('/seller/AjaxMyPost')}}",
                  "type": "POST",
                  "data":array,
              },
              columnDefs: [ {
                  orderable: false,
                  className: 'select-checkbox',
                  targets:   0
              } ],
              select: {
                  style:    'multi',
                  selector: 'td:first-child'
              },
              columns: [
                  { "data": "radio-button" },
                  { "data": "created_at"},
                  { "data": "id"},
                  { "data": "origin"},
                  { "data": "shape_label"},
                  { "data": "carat"},
                  { "data": "clarity_type_label"},
                  { "data": "color_label"},
                  { "data": "cut_type_label"},
                  { "data": "florescence_type_label"},
                  { "data": "price"},
                  { "data": "totalprice"}
              ],

              order: [[ 2, 'asc' ]]
          });
          table.columns().iterator( 'column', function (ctx, idx) {
                $( table.column(idx).header() ).find('.sort-icon').remove();    
                $( table.column(idx).header() ).append('<span class="sort-icon"/>');
            } );
      }
      
      /*$('#myTable tbody').on('click', 'tr', function () {
          //table.row(this).data();
          var req_id=table.row(this).data().id;
          if($(this).hasClass("selected")){
          $(this).removeClass("selected");    
          }else{
          $(this).toggleClass("selected");  
          getDiamondFulldetail(req_id);
          $("#research_slider").modal('show');
          }
      });*/
      
      $('#myTable').on('click','tbody tr', function (evt) {
        var $cell=$(evt.target).closest('td'), msg;
        
        if($cell.index()>0){
            //alert('do something');
              var req_id=table.row(this).data().id;
              console.log('req_id : '+req_id);
              if($(this).hasClass("selected")){
                $(this).removeClass("selected");    
              }else{
                $(this).toggleClass("selected");  
                getDiamondFulldetail(req_id);
                $("#research_slider").modal('show');
              }
        }
         });

      $('#compareselect').click(function (){
          var dataArr = [];
          $.each($("#myTable tr.selected"),function(){ 
              var id =  $('td:eq(2)', this).text();
              dataArr.push(id); 
          });

          var param={"dataArr":dataArr,
              "_token": "{{ csrf_token() }}"
          };
          if(dataArr.length>0){
          $.ajax({
             url:"{{URL::to('seller/compareDiamond')}}",
              data:param,
              type:"post",
              success:function(response){
                 var pophtml="";
                 var popthead="";

                  var rec=response.record;
                  var length=param.dataArr.length;
                    popthead+='<tr>';
                  popthead+='<th scope="col">&nbsp;&nbsp;</th>';
                    for(var i=0;i<length;i++){
                        popthead+='<th scope="col">'+
                                '<figure>'+
                                '<img src="../uploads/diamond_img/'+rec['diamond_image'][i]+'" alt="Diamond" title="Diamond">'+
                                '</figure>'+
                                rec['carat'][i]+'ct '+rec['shape_label'][i]
                               '</th>';
                    }
                  $("#comparethead").html(popthead);
                    pophtml+='<tr>'+
                              '<td scope="row">Date posted</td>';
                               for(var i=0;i<length;i++){
                                   pophtml+='<td>'+rec['created_at'][i]+'</td>';
                               }
                      pophtml+='</tr>';

                      pophtml+='<tr>'+
                                '<td scope="row">Price/Carat ($)</td>';
                                for(var i=0;i<length;i++){
                                    pophtml+='<td>'+rec['price'][i]+'</td>';
                                }
                      pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Total Price ($)</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['totalprice'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Id</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['id'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Country</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['country_id'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Mine</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['mine_id'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Producer</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['producer_id'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Shape</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['shape_label'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Carat</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['carat'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Clarity</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['clarity_label'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Colour</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['color_label'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Cut</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['cut_label'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Fluoresence</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['florescence_type_label'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Brand</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['brand_label'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>'+
                      '<td scope="row">Certification Laboratory</td>';
                  for(var i=0;i<length;i++){
                      pophtml+='<td>'+rec['certification_laboratory_label'][i]+'</td>';
                  }
                  pophtml+='</tr>';

                  pophtml+='<tr>';
                  pophtml += '<td scope="row">&nbsp;</td>';
                  for(var i=0;i<length;i++) {
                      pophtml +='<td><a href="javascript:void(0);" data-toggle="modal" data-target="#research_slider" onclick="addbodyclass(), getDiamondFulldetail('+rec['id'][i]+')" class="btn btn-primary">View Diamond</a></td>';
                  }
                  pophtml+='</tr>';

                $("#comptable").html(pophtml);
                $("#compare_diamonds").modal('show');
              }
          });
        }else{
            $("#comparethead").html('');
                $("#comptable").html('');
        }
      });
      function addbodyclass(){
                $('body').addClass("twomodal");
      }  
      function getDiamondFulldetail(id) {
        $.ajax({
           url:"{{URL::to('seller/getDiamondFullDetail')}}",
           data:"id="+id,
           type:"get",
           success:function(response){
              var popviewhtml="";
               var rec=response.record;
        
               //$(".leftheader #mainimage").attr('src','../uploads/diamond_img/'+rec['diamond_image'][0]);
                $(".editpostlink").attr("href","{{URL::to('seller/editpost')}}/"+rec['id']);
                $(".leftheader #maincarat").text(rec['carat']+'ct.');
                $(".leftheader #mainshape").text(rec['shape_label']);
                $(".leftheader #mainprice").text(rec['price']);
                $(".leftheader #maintotalprice").text(rec['totalprice']);
                $(".rightheader #maincountry").text(rec['country_id']);
                $(".rightheader #mainmine").text(rec['mine_id']);
                $(".rightheader #mainproducer").text(rec['producer_id']);
                
                if(rec['status']=="Deleted"){
                    $(".archivebtn").hide();
                    $(".editpostlink").hide();
                }else{
                    $(".archivebtn").show();
                    $(".editpostlink").show();
                }

                //$("#username").text(rec.user_name);
                //$("#comp_name").text(rec.comp_name);
               popviewhtml+='<tr>'+
               '<td>Date Posted</td>'+
               '<td align="right">'+rec['created_at']+'</td>'+
                   '</tr>'+
                   '<tr>'+
                   '<td>ID</td>'+
                   '<td align="right">'+rec['id']+'</td>'+
                   '</tr>'+
                   '<tr>'+
                   '<td>Carat</td>'+
                   '<td align="right">'+rec['carat']+'</td>'+
                   '</tr>'+
                   '<tr>'+
                   '<td>Clarity</td>'+
                   '<td align="right">'+rec['clarity_label']+'</td>'+
                   '</tr>'+
                   '<tr>'+
                   '<td>Colour</td>'+
                   '<td align="right">'+rec['color_label']+'</td>'+
               '</tr>'+
               '<tr>'+
               '<td>Cut</td>'+
               '<td align="right">'+rec['cut_label']+'</td>'+
                   '</tr>'+
                   '<tr>'+
                   '<td>Fluoresence</td>'+
                   '<td align="right">'+rec['florescence_type_label']+'</td>'+
                   '</tr>'+
                   '<tr>'+
                   '<td>Brand</td>'+
                   '<td align="right">'+rec['brand_label']+'</td>'+
                   '</tr>'+
                   '<tr>'+
                   '<td>Certification Laboratory</td>'+
               '<td align="right">'+rec['certification_laboratory_label']+'</td>'+
                   '</tr>'+
                   '<tr>'+
                   '<td>Certificate Number</td>'+
               '<td align="right">'+rec['certification_number']+'</td>'+
                   '</tr>';

               $("#viewdetailtbody").html(popviewhtml);

               var sliderhtml="";
               var sliderolhtml="";
               for(var i=0;i<rec['diamond_all_image'][0].length;i++) {
                   var active=(i==0)?'active':'';
                   sliderhtml += '<div class="carousel-item '+active+'">' +
                       '<img class="d-block w-100" src="../uploads/diamond_img/'+rec['diamond_all_image'][0][i]['name']+'" alt="Diamond">' +
                       '</div>';
                   sliderolhtml+='<li data-target="#diamond-slider" data-slide-to="'+i+'" class="'+active+'">'+
                       '<img class="d-block w-100" src="../uploads/diamond_img/'+rec['diamond_all_image'][0][i]['name']+'" alt="Diamond">'+
                       '</li>';
               }

               $("#diamond-slider .carousel-inner").html(sliderhtml);
               $("#diamond-slider .carousel-indicators").html(sliderolhtml);
               $(".download-pdf").attr("href","{{URL::to('seller/download-as-pdf')}}/"+rec['id']);
           }
        });

      }
      function archiveItem(){
        var dataArr=[];
        $.each($("#myTable tr.selected"),function(){ 
              var id =  $('td:eq(2)', this).text();
              dataArr.push(id); 
          });
        if(dataArr.length>0){
        $.ajax({
            url:"{{URL::to('seller/archivediamond')}}",
            data:{'_token': '{{ csrf_token() }}','dataArr':dataArr},
            type:"post",
            success:function(response){
                
                CalledAjax(filtersection,datesection,dropdownsection);  
                var shtml='<div class="alert-message">'+
                    '<div class="alert alert-success">'+
                    'Your Post Archived successfully.'+
                     '</div>'
                    '</div>';
                    $(".main-content").after(shtml);
                    setTimeout(function(){
                        $(".alert-message").fadeOut();
                    }, 2000);

            }
        });
       }
      }

      function archiveSingleItem() {
          var id=$("#viewdetailtbody tr:eq(1) td:eq(1)").text();
          if(id!=""){
           var param=[];
            param.push(id);
            $.ajax({
                url:"{{URL::to('seller/archivediamond')}}",
                data:{'_token': '{{ csrf_token() }}','dataArr':param},
                type:"post",
                success:function(response){
                    $("#research_slider").modal('hide');
                    CalledAjax(filtersection,datesection,dropdownsection);  
                    var shtml='<div class="alert-message">'+
                    '<div class="alert alert-success">'+
                    'Your Post Archived successfully.'+
                     '</div>'
                    '</div>';
                    $(".main-content").after(shtml);
                    setTimeout(function(){
                        $(".alert-message").fadeOut();
                    }, 2000);
                }
            });
       }
      }
      
      function deleteItem(){
        
        var dataArr=[];
        $.each($("#myTable tr.selected"),function(){ 
              var id =  $('td:eq(2)', this).text();
              dataArr.push(id); 
          });
        if(dataArr.length>0){
        $.ajax({
            url:"{{URL::to('seller/deletediamond')}}",
            data:{'_token': '{{ csrf_token() }}','dataArr':dataArr},
            type:"post",
            success:function(response){
                $('#custom-alert-box').hide();    
                CalledAjax(filtersection,datesection,dropdownsection); 
                var shtml='<div class="alert-message">'+
                    '<div class="alert alert-danger">'+
                    'Your Post Deleted successfully.'+
                     '</div>'
                    '</div>';
                    $(".main-content").after(shtml);
                    setTimeout(function(){
                        $(".alert-message").fadeOut();
                    }, 2000); 
            }
        });
       }
      }

      function deletesingleItem() {
          var id=$("#viewdetailtbody tr:eq(1) td:eq(1)").text();
          if(id!=""){
           var param=[];
            param.push(id);
            $.ajax({
                url:"{{URL::to('seller/deletediamond')}}",
                data:{'_token': '{{ csrf_token() }}','dataArr':param},
                type:"post",
                success:function(response){
                    console.log(response);
                    $('#custom-alert-box').hide();
                    $("#research_slider").modal('hide');
                    CalledAjax(filtersection,datesection,dropdownsection);  
                    var shtml='<div class="alert-message">'+
                    '<div class="alert alert-danger">'+
                    'Your Post Deleted successfully.'+
                     '</div>'
                    '</div>';
                    $(".main-content").after(shtml);
                    setTimeout(function(){
                        $(".alert-message").fadeOut();
                    }, 2000);
                }
            });
       }
      }
      $(".closeresearchmodal").on("click",function(){
        $('body').removeClass("twomodal");
      })
function showpopup(type){
    if(type=='single'){
        $(".deleterequest").attr("onclick","deletesingleItem()");    
    }else{
        $(".deleterequest").attr("onclick","deleteItem()");    
    }
    $('#custom-alert-box').show();
        setTimeout(function () {
            $('#custom-alert-box .alert-box').addClass('show-alert');
        }, 100);
}
    </script>
@endsection