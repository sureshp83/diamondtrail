@extends('layouts.app')
@section('title','Request diamond')
@section('content')
    <div id="post-a-diamond" class="req-a-diamond">
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-12 col-xs-12">
                <div class="sidebar-sticky" id="sidebar-one">
                    <div class="sidebar-content">
                        <h2>Request a Diamond</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing.</p>

                        <hr>
                        <ul class="step-list">
                            <li class="active-step"><span>1</span><a href="#">Diamond Details</a></li>
                            <li><span>2</span><a href="#">Review</a></li>
                        </ul>
                        {{--<a class="btn btn-inverse btn-full">Upload multiple diamonds at once</a>--}}

                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 col-md-12 col-xs-12">
                <form method="post" name="buyerpostdiamondstep1" action="{{URL::to('buyer/pdiamond-step1')}}"  enctype="multipart/form-data">
                    {{csrf_field()}}
                    @if(isset($diamond_detail))
                        <input type="hidden" name="diamond_id" value="{{$diamond_detail['id']}}">
                    @endif
                <div class="page-content">
                    <div class="container-fluid">
                        <div id="page-right-content">
                            <div class="origin-box">
                                <h2>Origin</h2>
                                <div class="row">
                                    <?php if(isset($diamond_detail)){
                                        $expArr=explode(',',$diamond_detail['origin']);
                                        foreach ($expArr as $value){
                                            $origin[]=explode('-',$value);
                                        }
                                        $org['country_id']=array_column($origin,0);
                                        $org['producer_id']=array_column($origin,1);
                                        $org['mine_id']=array_column($origin,2);
                                     } ?>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Country of Origin</label>
                                            <select name="country_id[]" id="country_id" class="multiSelect" multiple="multiple">
                                                {{--@if(!isset($org))
                                                    <option value="" selected>Select</option>
                                                @endif--}}
                                                <option {{(isset($org) && in_array("ALL",$org['country_id']))?'selected':''}} value="ALL">ALL</option>
                                                <option {{(isset($org) && in_array("BOT",$org['country_id']))?'selected':''}} value="BOT">BOT</option>
                                                <option {{(isset($org) && in_array("CAN",$org['country_id']))?'selected':''}} value="CAN">CAN</option>
                                                <option {{(isset($org) && in_array("LES",$org['country_id']))?'selected':''}} value="LES">LES</option>
                                                <option {{(isset($org) && in_array("BRAZ",$org['country_id']))?'selected':''}} value="BRAZ">BRAZ</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Producer</label>
                                            <select name="producer_id[]" id="producer_id" class="multiSelect" multiple="multiple">
                                                {{--@if(!isset($org))
                                                    <option value="" selected>select</option>
                                                @endif--}}
                                                @foreach($producer as $prod)
                                                 <option {{(isset($origin) && in_array($prod->name,$org['producer_id']))?'selected':''}} value="{{$prod->name}}">{{$prod->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Mine of Origin</label>
                                            <select name="mine_id[]" id="mine_id" class="multiSelect" multiple="multiple">
                                                {{--@if(!isset($org))
                                                    <option value="" selected>select</option>
                                                @endif--}}

                                                @foreach($mines as $mine)
                                                <option {{(isset($org) && in_array($mine->name,$org['mine_id']))?'selected':''}} value="{{$mine->name}}">{{$mine->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--<hr>
                            <div class="price-box">
                                <h2>Price</h2>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Price/Carat($)</label>
                                            <div class="placeholder-text">US$/ct</div>
                                            <input type="text" class="form-control" name="price" id="price" value="{{(isset($diamond_detail)?$diamond_detail['price']:'')}}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Total Price ($)</label>
                                            <div class="placeholder-text">US$</div>
                                            <input type="text" name="totalprice" id="totalprice" value="{{(isset($diamond_detail)?$diamond_detail['totalprice']:'')}}" placeholder="" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}

                            <hr>
                            <div class="diamond_details">
                                <h2>Diamond Details</h2>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Shape</label>
                                            <div class="diamond-shapes">
                                                @foreach($shapes as $key => $shape)
                                                    @if(isset($diamond_detail))
                                                        <div class="single-shape {{(($shape->id)==$diamond_detail['shape_id']) ? 'active':''}}">
                                                            <input type="radio" id="{{$shape->id}}" name="shape_id" value="{{$shape->id}}" {{(($shape->id)==$diamond_detail['shape_id'])?'checked':''}}>

                                                            <figure>
                                                                <img src="{{URL::to('/images')}}/{{$shape->img}}" alt="Round" title="Round">
                                                            </figure>
                                                            <label for="{{$shape->id}}" class="text-uppercase control-label">{{$shape->label}}</label>
                                                        </div>
                                                    @else
                                                        <div class="single-shape {{($key==0)?'active':''}}">
                                                            <input type="radio" id="{{$shape->id}}" name="shape_id" value="{{$shape->id}}" {{($key==0)?'checked':''}}>

                                                            <figure>
                                                                <img src="{{URL::to('/images')}}/{{$shape->img}}" alt="Round" title="Round">
                                                            </figure>
                                                            <label for="{{$shape->id}}" class="text-uppercase control-label">{{$shape->label}}</label>
                                                        </div>
                                                    @endif

                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-5 col-xs-12 carat">
                                        <label class="control-label">Carat</label>
                                        <div class="form-group">
                                            <label class="control-label">Min</label>
                                            <input type="text" name="carat_min" id="carat_min" value="{{(isset($diamond_detail)?$diamond_detail['carat_min']:'')}}" placeholder="0.00" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-xs-12 carat vertically-center text-sm-center">
                                        <label class="control-label" style="display: block;">&nbsp;</label>
                                        <i class="fas fa-minus" style="margin-top: 20px;"></i>
                                    </div>
                                    <div class="col-lg-2 col-md-5 col-xs-12 carat">
                                        <label class="control-label">&nbsp;</label>
                                        <div class="form-group">
                                            <label class="control-label">Max</label>
                                            <input type="text" name="carat_max" id="carat_max" value="{{(isset($diamond_detail)?$diamond_detail['carat_max']:'')}}" placeholder="0.00" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6 col-md-5 col-xs-12 range-filter">
                                        <br>
                                        <div class="form-group">
                                            <label class="control-label">Clarity</label>
                                            {{--<input id="clarity" name="clarity" type="text" data-slider-min="1" data-slider-max="5" value="" data-slider-value="{{isset($diamond_detail['clarity_type_id'])? $diamond_detail['clarity_type_id'] : 1}}" >--}}
                                            <input id="clarity" name="clarity" type="text" data-value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-xs-12 colour">
                                        <br>
                                        <div class="form-group">
                                            <label class="control-label"> Colour</label>
                                            <div class="form-check">
                                                <input class="form-check-input radio-input" type="radio" name="colour" id="colourless" value="colourless" {{(isset($diamond_detail['intensity_id']) && $diamond_detail['intensity_id']!=null)?'':'checked'}}>
                                                <label class="form-check-label control-label radio-btn" for="colourless">
                                                    Colourless
                                                </label>
                                            </div>
                                            <div class="form-group colourless" >
                                                <input id="colourless_slider" name="colourless_slider" type="text" data-value="" value="" data-slider-value="{{(isset($diamond_detail) && isset($diamond_detail['intensity_id']))?'':isset($diamond_detail['color_id'])?$diamond_detail['color_id']:''}}">
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input radio-input" type="radio" name="colour" id="fancy_colour" value="fancy_colour" {{(isset($diamond_detail['intensity_id']) && $diamond_detail['intensity_id']!=null)?'checked':''}}>
                                                <label class="form-check-label control-label radio-btn" for="fancy_colour">
                                                    Fancy Colour
                                                </label>
                                            </div>
                                            <div class="form-group fancy_colours">
                                                <label class="control-label"> Intensity</label>
                                                <input id="intensity" name="intensity" type="text" data-slider-ticks="1" data-slider-ticks-snap-bounds="1" data-slider-ticks-labels="" data-value="" value="" data-slider-value="{{isset($diamond_detail['intensity_id'])?$diamond_detail['intensity_id']:1}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-8 col-md-8 col-xs-12 multiple-colour">
                                        <br>

                                            <div class="row fancy_colours">
                                                <div class="col-lg-4 col-md-4 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label"> Colour 1</label>
                                                        @foreach($fancy_colors as $key=> $fcolor)
                                                            <div class="form-check">
                                                            @if((isset($diamond_detail['fancy_color_gp'][0]))) 
                                                                <input class="form-check-input radio-input" type="radio" name="colour_1" id="cl1{{$fcolor->id}}" value="{{$fcolor->id}}" {{(isset($diamond_detail['fancy_color_gp'][0]) && $diamond_detail['fancy_color_gp'][0] == $fcolor->id) ? 'checked':'' }}>
                                                            @else
                                                            <input class="form-check-input radio-input" type="radio" name="colour_1" id="cl1{{$fcolor->id}}" value="{{$fcolor->id}}" {{($key==0)?'checked':''}}>
                                                            @endif    
                                                                <label class="form-check-label control-label radio-btn" for="cl1{{$fcolor->id}}">
                                                                    {{$fcolor->label}}
                                                                </label>
                                                            </div>
                                                         @endforeach
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label"> Colour 2</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input radio-input" type="radio" name="colour_2" id="cl20" value="fancy_color_2" checked="checked">
                                                            <label class="form-check-label control-label radio-btn" for="cl20">
                                                                None
                                                            </label>
                                                        </div>
                                                        @foreach($fancy_colors as $fcolor)
                                                            <div class="form-check">
                                                                <input class="form-check-input radio-input" type="radio" name="colour_2" id="cl2{{$fcolor->id}}" value="{{$fcolor->id}}" {{(isset($diamond_detail['fancy_color_gp'][1]) && $diamond_detail['fancy_color_gp'][1]==$fcolor->id) ? 'checked' :''}}>
                                                                <label class="form-check-label control-label radio-btn" for="cl2{{$fcolor->id}}">
                                                                    {{$fcolor->label}}
                                                                </label>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label"> Colour 3</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input radio-input" type="radio" name="colour_3" id="cl30" value="fancy_color_3" checked="checked">
                                                            <label class="form-check-label control-label radio-btn" for="cl30">
                                                                None
                                                            </label>
                                                        </div>
                                                        @foreach($fancy_colors as $fcolor)
                                                            <div class="form-check">
                                                                <input class="form-check-input radio-input" type="radio" name="colour_3" id="cl3{{$fcolor->id}}" value="{{$fcolor->id}}" {{(isset($diamond_detail['fancy_color_gp'][2]) && $diamond_detail['fancy_color_gp'][2]==$fcolor->id) ? 'checked' :''}}>
                                                                <label class="form-check-label control-label radio-btn" for="cl3{{$fcolor->id}}">
                                                                    {{$fcolor->label}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-5 col-md-5 col-xs-12 cut">
                                        <br>
                                        <div class="form-group">
                                            <label class="control-label">Cut</label>
                                            <input id="cut" type="text" name="cut_id"  data-value="1" value="1" data-slider-value="{{(isset($diamond_detail)?$diamond_detail['cut_type_id']:1)}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-5 col-lg-6 col-md-6 col-xs-12 fluorescence">
                                        <br>
                                        <div class="form-group">
                                            <label class="control-label">Fluorescence</label>
                                            <input id="fluorescence" name="fluorescence" type="text" data-value="1" value="1" data-slider-value="{{(isset($diamond_detail)?$diamond_detail['florescence_type_id']:1)}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="brand-box">
                                <h2>Brand</h2>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                           <?php if(isset($diamond_detail['brand_id'])){
                                            $brandids=explode(',', $diamond_detail['brand_id']);
                                           }?> 
                                            <!--<label class="control-label">Producer</label>-->
                                            <select name="brand_id[]" id="brand_id" class="multiSelect" multiple="multiple">
                                                
                                                @foreach($brands as $brand)

                                                    <option {{(isset($diamond_detail) && in_array($brand->id,$brandids)) ? 'selected' :''}} value="{{$brand->id}}">{{$brand->label}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="certification-box">

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <h2>Certification Laboratory</h2>
                                            <?php if(isset($diamond_detail['certification_laboratory_id'])){
                                            $cerids=explode(',', $diamond_detail['certification_laboratory_id']);
                                           }?> 
                                            <select name="certification_laboratories_id[]" id="certification_laboratories_id" class="multiSelect" multiple="multiple">
                                                
                                                @foreach($certification_laboratories as $certificate)

                                                    <option {{(isset($diamond_detail) && in_array($certificate->id,$cerids)) ? 'selected' :''}} value="{{$certificate->id}}">{{$certificate->label}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--<div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label">Certificate Number</label>
                                            <input type="text" id="certificate_number" name="certificate_number" placeholder="#0000000" value="{{(isset($diamond_detail) ? $diamond_detail['certification_number'] :'')}}" class="form-control">
                                        </div>
                                    </div>--}}
                                    {{--<div class="col-lg-4 col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label btn-block">Diamond Certificate</label>
                                            <div class="input-group mb-3 file-btn">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="diamond_certi_file" value="{{(isset($diamond_detail)? $diamond_detail['diamond_certi_file'] : '')}}" name="diamond_certi_file" accept=".pdf">
                                                    <label class="custom-file-label" for="diamond_certi_file">Upload PDF</label>
                                                    {{(isset($diamond_detail)? $diamond_detail['diamond_certi_file'] : '')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>--}}
                                </div>
                            </div>

                            <hr>
                            <div class="images-box">
                                <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                <h2>Comment<span></span></h2>
                                    <p>300 characters</p>
                                <div class="form-group">
                                    <textarea name="comments" id="comments" class="requestComment form-control" rows="4" placeholder="Enter short comment">{{isset($diamond_detail['comments'])? $diamond_detail['comments']:''}}</textarea>
                                </div>
                                </div>
                                </div>
                            </div>

                            <hr>
                            <div class="footer-buttons text-sm-right">
                                <a class="btn btn-secondary float-sm-left" href="{{URL::to('/buyer/dashboard')}}">Cancel</a>
                                <input type="submit" name="submit" value="Next step" class="btn btn-primary">
                            </div>

                        </div>
                    </div>
                </div>
                </form>
            </div>

      </div>
    </div>
    <script>
        $(document).ready(function () {
            <?php
            if(isset($diamond_detail['clarity_type_id'])){
                $Clarityvalue="[". $diamond_detail['clarity_type_id'] ."]";
            }else{
                $Clarityvalue="[1,2]";
            }

            ?>
            var slider = new Slider("#clarity", {
                min: 1,
                max: 5,
                value:<?php echo $Clarityvalue;?>,
                ticks:<?php echo json_encode($clarity_types_id);?>,
                ticks_labels: <?php echo json_encode($clarity_types_label);?>
            });

            
            var slider_colourless=new Slider("#colourless_slider",{
                min: 1,
                max: 5,
                value: <?php echo (isset($diamond_detail['color_id']) ? "[" .$diamond_detail['color_id'] ."]":"[1,2]");?>,
                ticks: <?php echo json_encode($colorless_color_id);?>,
                ticks_labels: <?php echo json_encode($colorless_color_label);?>,
                ticks_snap_bounds:1
            });
            
                var slider_1 = new Slider("#intensity", {
                min: 1,
                max: 5,
                value:<?php echo (isset($diamond_detail['intensity_id'])? "[" .$diamond_detail['intensity_id'] ."]":"[1,2]");?>,
                ticks: <?php echo json_encode($intensity_id);?>,
                ticks_labels: <?php echo json_encode($intensity_name);?>,
                ticks_snap_bounds: 1
            });
            
            var slider_3 = new Slider("#fluorescence", {
                min: 1,
                max: 5,
                value: <?php echo isset($diamond_detail['florescence_type_id']) ? "[". $diamond_detail['florescence_type_id'] ."]" :  "[1,2]" ?>,
                ticks: <?php echo json_encode($florescence_types_id); ?>,
                ticks_labels: <?php echo json_encode($florescence_types_label);?>,
                ticks_snap_bounds: 1
            });

            var slider_2 = new Slider("#cut", {
                min:1,
                max:2,
                value: <?php echo isset($diamond_detail['cut_type_id']) ? "[". $diamond_detail['cut_type_id'] ."]" : "[1,2]" ?>,
                ticks: <?php echo json_encode($cut_types_id);?>,
                ticks_labels: <?php echo json_encode($cut_types_label);?>,
                ticks_snap_bounds: 1
            });
            <?php if(isset($diamond_detail['intensity_id'])) { ?>
            $(".fancy_colours").show();
            $(".colourless").hide();
            <?php }else{ ?>
            $(".fancy_colours").hide();
            $(".colourless").show();
            <?php  } ?>

        });

    </script>
@endsection