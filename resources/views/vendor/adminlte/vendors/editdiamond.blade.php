@extends('adminlte::layouts.app')
@section('contentheader_title','Edit Diamond')
@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<div class="box box-primary admin">
<form role="form" method="post" id="adminedituser" action="{{URL::to('/admin/edit-diamond')}}/{{$diamond_detail['id']}}" name="editdiamond" enctype="multipart/form-data">
{{csrf_field()}}
<input type="hidden" name="diamond_id" value="{{$diamond_detail['id']}}">
<input type="hidden" name="user_id" value="{{$diamond_detail['user_id']}}">
<div class="box-header with-border">
     <h3 class="box-title">Diamond Detail</h3>
</div>
<div class="box-body">
		<div class="origin-box">
		  <h4>Origin</h4>
			<div class="row">
			<?php if(isset($diamond_detail)){
                $origin=explode('-',$diamond_detail['origin']);
             } ?>
             <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="form-group {{$errors->has('country_id')? 'has-error':''}}">
                    <label class="control-label">Country of Origin</label>
                    <select name="country_id" id="country_id" class="form-control" required>
                        <option value="" selected>Select</option>
                        <option {{(isset($origin) && $origin[0]=="BOT")?'selected':''}} value="BOT">BOT</option>
                        <option {{(isset($origin) && $origin[0]=="CAN")?'selected':''}} value="CAN">CAN</option>
                        <option {{(isset($origin) && $origin[0]=="LES")?'selected':''}} value="LES">LES</option>
                        <option {{(isset($origin) && $origin[0]=="BRAZ")?'selected':''}} value="BRAZ">BRAZ</option>
                    </select>
                    @if($errors->has('country_id'))
                    	<span class="help-block">
                    		<strong>{{$errors->first('country_id')}}</strong>
                    	</span>
                    @endif
                </div>
             </div>
             <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="form-group {{$errors->has('producer_id')? 'has-error':''}}">

                    <label class="control-label">Producer</label>
                    <select name="producer_id" id="producer_id" class="form-control">
                        <option value="" selected>Select</option>
                        @foreach($producer as $prod)
                         <option {{(isset($origin) && $origin[1]==$prod->name)?'selected':''}} value="{{$prod->name}}">{{$prod->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('producer_id'))
                    	<span class="help-block">
                    		<strong>{{$errors->first('producer_id')}}</strong>
                    	</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">    
                <div class="form-group {{$errors->has('mine_id')? 'has-error':''}}">
                    <label class="control-label">Mine of Origin</label>
                    <select name="mine_id" id="mine_id" class="form-control">
                        <option value="" selected>Select</option>
                        @foreach($mines as $mine)
                        <option {{(isset($origin) && $origin[2]==$mine->name)?'selected':''}} value="{{$mine->name}}">{{$mine->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('mine_id'))
                    	<span class="help-block">
                    		<strong>{{$errors->first('mine_id')}}</strong>
                    	</span>
                    @endif
                </div>

            </div>
			</div>	  
		</div>
		<hr>
		<div class="price-box">
			<h4>Price</h4>
		        <div class="row">
		            <div class="col-lg-4 col-md-4 col-xs-12">
		                <div class="form-group {{$errors->has('price') ? ' has-error':''}}">
		                    <label class="control-label">Price/Carat($)</label>
		                    <div class="placeholder-text">US$/ct</div>
		                    <input type="text" class="form-control" name="price" id="price" value="{{(isset($diamond_detail)?number_format($diamond_detail['price']):'')}}" required oninput="calculateTotalValue()">
		                  	@if($errors->has('price'))
		                    	<span class="help-block">
		                    		<strong>{{$errors->first('price')}}</strong>
		                    	</span>
		                    @endif  
		                </div>
		            </div>
		            <div class="col-lg-4 col-md-4 col-xs-12">
		                <div class="form-group">
		                    <label class="control-label">Total Price ($)</label>
		                    <div class="placeholder-text">US$</div>
		                    <input type="text" name="totalprice" id="totalprice" value="{{(isset($diamond_detail)?number_format($diamond_detail['totalprice']):'')}}" placeholder="" class="form-control" required readonly="readonly">
		                </div>
		            </div>
		        </div>
		</div>
		<hr>
            <div class="diamond_details">
            <h4>Diamond Details</h4>
            	<div class="row">
            		<div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Shape</label>
                            <div class="diamond-shapes">
                                @foreach($shapes as $key => $shape)
                                    @if(isset($diamond_detail))
                                        <div class="single-shape {{(($shape->label)==$diamond_detail['shape_label']) ? 'active':''}}">
                                            <input type="radio" id="{{$shape->id}}" name="shape_id" value="{{$shape->id}}" {{(($shape->label)==$diamond_detail['shape_label'])?'checked':''}}>

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
                    <div class="col-lg-4 col-md-4 col-xs-12 carat">
                        <div class="form-group {{$errors->has('carat')?' has-error':''}}">
                            <label class="control-label">Carat</label>
                            <input type="text" name="carat" id="carat" value="{{(isset($diamond_detail)?$diamond_detail['carat']:'')}}" placeholder="0.00" class="form-control" oninput="calculateTotalValue()">
                            @if($errors->has('carat'))
		                    	<span class="help-block">
		                    		<strong>{{$errors->first('carat')}}</strong>
		                    	</span>
		                    @endif  
                        </div>
                    </div>
            	</div>
            	<div class="row">
                    <div class="col-xl-4 col-lg-6 col-md-5 col-xs-12 range-filter">
                        <br>
                        <div class="form-group">
                            <label class="control-label">Clarity</label>
                            <input id="clarity" name="clarity" type="text" data-value="" value="" data-slider-value="{{isset($diamond_detail['clarity_type_id'])? $diamond_detail['clarity_type_id'] : 1}}">
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
                                <input id="intensity" name="intensity" type="text" data-slider-ticks="[1, 2, 3, 4, 5, 6, 7, 8, 9]" data-slider-ticks-snap-bounds="1" data-slider-ticks-labels='["Fai", "V-Li", "Li", "F-Li", "F", "F-In", "F-Da", "F-De", "F-Vi"]' data-value="" value="" data-slider-value="{{isset($diamond_detail['intensity_id'])?$diamond_detail['intensity_id']:1}}">
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
                                        @php
											$count1 = 0
										@endphp
                                        @foreach($fancy_colors as $fcolor)
                                            <div class="form-check dd">
												@php
													$i = 0
												@endphp
												@if(isset($diamond_detail['fancy_color_gp'][0])) 
													@php
													$i = 1
													@endphp
												@else  
												@endif
                                                <input class="form-check-input radio-input" type="radio" name="colour_1" id="cl1{{$fcolor->id}}" value="{{$fcolor->id}}" {{(isset($diamond_detail['fancy_color_gp'][0]) && $diamond_detail['fancy_color_gp'][0] == $fcolor->id )? 'checked' : ''}} {{ $i == 0 && $count1 == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label control-label radio-btn" for="cl1{{$fcolor->id}}">
                                                    {{$fcolor->label}}
                                                </label>
                                            </div>
                                            @php
											 $count1++
											@endphp
                                         @endforeach
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label"> Colour 2</label>
                                        <div class="form-check">
											@php
													$ii = 0
												@endphp
											@if(isset($diamond_detail['fancy_color_gp'][1])) 
													@php
													$ii = 1
													@endphp
												@else  
												@endif
                                            <input class="form-check-input radio-input" type="radio" name="colour_2" id="cl20" value="0" {{(isset($diamond_detail['fancy_color_gp'][1]) && $diamond_detail['fancy_color_gp'][1]==0) ? 'checked' :''}} {{ $ii ==  0 ? 'checked' : ''}}>
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
											@php
													$iii = 0
												@endphp
											@if(isset($diamond_detail['fancy_color_gp'][2])) 
													@php
													$iii = 1
													@endphp
												@else  
												@endif
                                            <input class="form-check-input radio-input" type="radio" name="colour_3" id="cl30" value="0" {{(isset($diamond_detail['fancy_color_gp'][2]) && $diamond_detail['fancy_color_gp'][2]==0) ? 'checked' :''}} {{ $iii ==  0 ? 'checked' : ''}}>
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
                            <input id="cut" type="text" name="cut_id" data-slider-ticks="[0, 100, 200, 300]" data-slider-ticks-snap-bounds="1" data-slider-ticks-labels='["Excellent", "Very Good", "Good", "Fair-Poor"]' data-value="1" value="1" data-slider-value="{{(isset($diamond_detail)?$diamond_detail['cut_type_id']:1)}}">
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-6 col-xs-12 fluorescence">
                        <br>
                        <div class="form-group">
                            <label class="control-label">Fluorescence</label>
                            <input id="fluorescence" name="fluorescence" type="text" data-slider-ticks="[0, 100, 200, 300, 400]" data-slider-ticks-snap-bounds="1" data-slider-ticks-labels='["None", "Faint", "Medium", "Strong", "Very Strong"]' data-value="1" value="1" data-slider-value="{{(isset($diamond_detail)?$diamond_detail['florescence_type_id']:1)}}">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
                <div class="brand-box">
                    <h4>Brand</h4>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
                            <div class="form-group">
                                <!--<label class="control-label">Producer</label>-->
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="" selected>Select</option>
                                    @foreach($brands as $brand)
                                        @if($brand->label!="ANY")
                                        <option {{(isset($diamond_detail) && $diamond_detail['brand_id'] == $brand->id) ? 'selected' :''}} value="{{$brand->id}}">{{$brand->label}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <hr>
            <div class="certification-box">
                <h4>Certification</h4>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Certification Laboratory</label>
                            <select name="certification_laboratories_id" id="certification_laboratories_id" class="form-control">
                                <option value="" selected>Select</option>
                                @foreach($certification_laboratories as $certificate)
                                    @if($certificate->label!="ALL")
                                    <option {{(isset($diamond_detail) && $diamond_detail['certification_laboratory_id'] == $certificate->id) ? 'selected' :''}} value="{{$certificate->id}}">{{$certificate->label}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div class="form-group">
                            <label class="control-label">Certificate Number</label>
                            <input type="text" id="certificate_number" name="certificate_number" placeholder="#0000000" value="{{(isset($diamond_detail) ? $diamond_detail['certification_number'] :'')}}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-12">
                        <div class="form-group file-btn">
                            <label class="control-label btn-block">Diamond Certificate</label>
                            <label class="custom-file-label" for="diamond_certi_file">Upload PDF</label>
                            <input type="file" class="form-control custom-file-input" id="diamond_certi_file" value="{{(isset($diamond_detail)? $diamond_detail['diamond_certi_file'] : '')}}" name="diamond_certi_file" accept=".pdf">
                            @if(isset($diamond_detail['diamond_certi_file']) && $diamond_detail['diamond_certi_file']!=null)
                                <a href="javascript:void(0);" onclick="deletesellerDCer()" id="remove-seller-Dfile" class="remove-file">{{$diamond_detail['diamond_certi_file']}}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>    
            <hr>
                <div class="brand-box">
                    <h4>Status</h4>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-xs-12">
                            <div class="form-group">
                              <label class="control-label">Status</label>
                              <div>
                                <label>
                                  <input type="radio" name="status" class="flat-red" value="Active" {{($diamond_detail['status'] == 'Active')?'checked':''}}>&nbsp;&nbsp;  Active
                              </label>&nbsp;&nbsp;
                              <label>
                              <input type="radio" name="status" class="flat-red" value="Pending" {{($diamond_detail['status'] == 'Pending')?'checked':''}}>&nbsp;&nbsp; Pending
                              </label>&nbsp;&nbsp;
                              <label>
                                  <input type="radio" name="status" class="flat-red" value="Archived" {{($diamond_detail['status'] == 'Archived')?'checked':''}}>&nbsp;&nbsp; Archived
                              </label>
                          </div>
                      </div>
                        </div>
                    </div>
                </div>
            <hr>
            <div class="images-box">
                <h4>Images<span>(Jpeg, Maximum of 4)</span></h4>
                <div class="input-group mb-3 file-btn">
                    @if(isset($diamond_img) && $diamond_img!=null)
                        <div class="diamond-uploaded-img">
                            @foreach($diamond_img as $key => $img)
                                <div class="single-uploaded-img">
                                    <figure>
                                        <img src="{{URL::to('uploads/diamond_img')}}/{{$img->name}}" alt="Diamond" title="Diamond">
                                        <span class="delete-image" data-value="{{$img->id}}"><i class="fas fa-times-circle"></i></span>
                                    </figure>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div id="diamondimgCount" data-value="{{(isset($diamond_img)?count($diamond_img):0)}}">
                    <div class="custom-file">
                        <label class="custom-file-label" for="diamond_images">Upload Images</label>
                        <input class="custom-file-input" size="4" name="diamond_images[]" id="diamond_images" type="file" multiple="multiple" accept="image/jpeg">

                    </div>
                    </div>
                </div>
                <br>
            </div>
            <hr>
            <div class="col-md-12 col-sm-12 col-lg-12">
		      <div class="row">
		       <div class="col-md-2 col-sm-6 col-lg-2">
		      	<a href="{{URL::to('admin/view-diamonds')}}/{{$diamond_detail['user_id']}}" class="btn btn-block btn-default">Back</a>
		       </div>
		       <div class="col-md-2 col-sm-6 col-lg-2">
		      	<button type="submit" class="btn btn-block btn-primary">Save</button>
		       </div>
		       </div>	 
      		</div>


</div>
</form>
</div>	
<script>
        $(document).ready(function () {
            var slider = new Slider("#clarity", {
                ticks: <?php echo json_encode($clarity_types_id);?>,
                ticks_labels: <?php echo json_encode($clarity_types_label);?>,
                ticks_snap_bounds:1
            });


            var slider_1 = new Slider("#intensity", {
                ticks: <?php echo json_encode($intensity_id);?>,
                ticks_labels: <?php echo json_encode($intensity_name);?>,
                ticks_snap_bounds: 1
            });

            var slider_colourless=new Slider("#colourless_slider",{
                ticks: <?php echo json_encode($colorless_color_id);?>,
                ticks_labels: <?php echo json_encode($colorless_color_label);?>,
                ticks_snap_bounds:1
            });



            var slider_3 = new Slider("#fluorescence", {
                ticks: <?php echo json_encode($florescence_types_id); ?>,
                ticks_labels: <?php echo json_encode($florescence_types_label);?>,
                ticks_snap_bounds: 1
            });

            var slider_2 = new Slider("#cut", {
                ticks: <?php echo json_encode($cut_types_id);?>,
                ticks_labels: <?php echo json_encode($cut_types_label);?>,
                ticks_snap_bounds: 1
            });
            <?php if(isset($diamond_detail['intensity_id']) && $diamond_detail['intensity_id']!=null) { ?>
            $(".fancy_colours").show();
            $(".colourless").hide();
            <?php }else{ ?>
            $(".fancy_colours").hide();
            $(".colourless").show();
            <?php  } ?>

        });
        $("#fancy_colour").change(function() {
       if($(this).is(":checked")){
           $(".fancy_colours").show();
           $(".colourless").hide();
       }
    });
    $("#colourless").change(function(){
        if($(this).is(":checked")){
            $(".colourless").show();
            $(".fancy_colours").hide();
        }
    });

    $("form[name='editdiamond']").validate({
			//alert('lenght : '+diamond_images.length);
            // Specify validation
            //errorElement: 'span',
            //debug: true,
            rules: {
                country_id:'required',
                mine_id:'required',
                producer_id:'required',
                price:'required',
                totalprice:'required',
                shape_id:'required',
                carat:'required',
                brand_id:'required',
                certification_laboratories_id:'required',
                certificate_number:'required',
                diamond_certi_file:{
                    required: function(){
                        return $("#diamond_certi_file").attr("value")=="";
                    }
                },
                'diamond_images[]':{
                    required: function(){
                        return $("#diamondimgCount").attr("data-value")==0;
                        maxlength: 4
                    }
                },

            },
            messages: {
                country_id:"Please select country of origin.",
                mine_id:"Please select mine of origin.",
                producer_id:"Please select producer of origin.",
                price:"Please enter price.",
                totalprice:"Please enter total price.",
                shape_id:"Please select shape.",
                carat:"Please enter carat.",
                brand_id:"Please select brand.",
                certification_laboratories_id:"Please select certification laboratories.",
                certificate_number:"Please enter certificate number.",
                diamond_certi_file:'Please Select Diamond Certificate',
                'diamond_images[]':'Please Select Diamond Images',
            },

            submitHandler: function (form) {
                form.submit();
            }
        });

    $('.delete-image').click(function () {
        $(this).parent().parent().fadeOut('slow');
    });

        //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });
    </script>
@endsection