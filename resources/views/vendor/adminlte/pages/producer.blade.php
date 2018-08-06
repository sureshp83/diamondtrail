@extends('adminlte::layouts.app')
@section('contentheader_title','Edit Producers Page Content')
@section('main-content')
<div class="box box-primary admin">
<form role="form" method="post" id="adminedituser" name="adminedituser" action="{{URL::to('/admin/content/producer')}}" enctype="multipart/form-data">
{{csrf_field()}}
<div class="box-header with-border">
     <h3 class="box-title">Block Wise Content</h3>
     <button type="button" class="btn-copy btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse" style="float:right;">
                  	<i class="fa fa-plus"></i>&nbsp;&nbsp;Add New Producer</button>

</div>

<div class="box-body">
      <?php if(!isset($content)){ ?> 
  				<div class="row" id="addnew1">
  						<div class="col-md-4 col-sm-6 col-lg-4">
	            			<div class="form-group">
	            				<label class="control-label">Producer Name</label>
	            				<input type="text" name="producer_name1" id="producer_name1" class="form-control">
	            			</div>
	            		</div>
	            		<div class="col-md-4 col-sm-6 col-lg-4">
	            			<div class="form-group">
	            				<label class="control-label">Images</label>
	            				<input type="file" name="producer_images1[]" id="producer_images1" class="form-control" multiple="multiple" accept="image/x-png,image/gif,image/jpeg" />
	            			</div>
	            		</div>
	            		<div class="col-md-4 col-sm-6 col-lg-4 closebtn">
	            			<div class="form-group">
	            				<label class="control-label">Pdf file.</label>
	            				<input type="file" name="producer_pdf_file1" id="producer_pdf_file1" class="form-control" accept=".pdf" />
	            			</div>
	            		</div>

	  				<div class="col-md-12 col-sm-12 col-lg-12">
	          			<lable class="control-label" for="content">Page Content</lable>
				            <!-- /.box-header -->
	                    <textarea id="editor1" class="tinymce" name="editor1" rows="10" cols="80">
	                       
	                    </textarea>
	                     <input name="image" type="file" id="upload" class="hidden" onchange="">
	                     <input type="hidden" name="imagename" id="imagename" value="">
	          <!-- /.box -->
	        		</div>
	        	<hr>	
        		</div>
        <?php }else{ ?>
        @foreach ($content as $key => $value)
        
          <div class="row" id="addnew{{$key+1}}">
          <input type="hidden" name="producer_id{{$key+1}}" id="producer_id{{$key+1}}" value="{{$value['producer_id']}}"> 
                  <div class="col-md-4 col-sm-6 col-lg-4">
                    <div class="form-group">
                      <label class="control-label">Producer Name</label>
                      <input type="text" name="producer_name{{$key+1}}" id="producer_name{{$key+1}}" class="form-control" value="{{$value['producer_name']}}">
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-4 col-lg-3">
                    <div class="form-group">
                      <label class="control-label">Images</label>
                      <input type="file" name="producer_images{{$key+1}}[]" id="producer_images{{$key+1}}" class="form-control" multiple="multiple" accept="image/x-png,image/gif,image/jpeg" />

                      <div class="diamond-uploaded-img">
                        
                        @foreach ($value['images'] as $ik => $img)
                        <div class="single-uploaded-img">
                          <figure>
                            <img src="{{asset('producer/pages_img/')}}/{{$img->image}}" alt="Diamond" title="Diamond">
                            <span class="delete-pimage" data-value="{{$img->id}}"><i class="fas fa-times-circle"></i></span>
                          </figure>
                        </div>
                        @endforeach    
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-4 col-lg-3 closebtn">
                    <div class="form-group">
                      <label class="control-label">Pdf file.</label>
                      <input type="file" name="producer_pdf_file{{$key+1}}" id="producer_pdf_file{{$key+1}}" class="form-control" data-value="{{$value['producer_file']}}" accept=".pdf" />
                      @if(isset($value['producer_file']) && $value['producer_file']!=null)
                      <a href="javascript:void(0);" id="producer_pdffile" onclick="RemoveProducerPdf({{$key+1}})" class="remove-file">{{$value['producer_file']}}</a>
                      @endif
                      
                    </div>
                  </div>
                  <div class="col-md-2 col-sm-2 col-lg-2">
                    <div class="removebtn pad">
                      <button type="button" class="btn btn-info btn-sm" title="" onclick="removediv({{$key+1}})">
                        <i class="fa fa-times"></i></button>
                    </div>
                  </div>
            <div class="col-md-12 col-sm-12 col-lg-12">
                  <lable class="control-label" for="content">Page Content</lable>
                    <!-- /.box-header -->
                      <textarea id="editor{{$key+1}}" class="tinymce" name="editor{{$key+1}}" rows="10" cols="80">
                      {{$value['producer_content']}}                         
                      </textarea>
                       <input name="image" type="file" id="upload" class="hidden" onchange="">
                       <input type="hidden" name="imagename" id="imagename" value="">
            <!-- /.box -->
              </div>
            <hr>  
            </div>
        @endforeach
        <?php }?>  
          	<div class="row">
          		<div class="col-md-2 col-sm-6 col-lg-2">
          		<a href="{{URL::to('admin/dashboard')}}" class="btn btn-block btn-default">Back</a>
          		</div>
          		<div class="col-md-2 col-sm-6 col-lg-2">
          			<button type="submit" class="btn btn-block btn-primary">Save</button>
          		</div>
          	</div>	 
</div>
<input type="hidden" name="blockcount" id="blockcount" value="1">  			
</form>
</div>
<div class="modal modal-danger fade in" id="modal-danger">
          <div class="modal-dialog">
            <div class="modal-content">
            <form method="post" action="#" id="deletediamondform">
            {{csrf_field()}}
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Diamond</h4>
              </div>
              <div class="modal-body">

                <h4>Are you sure <br>
                you want to delete producer ?</h4>
              </div>
              <input type="hidden" name="producerid" id="producerid" value="">
              <input type="hidden" name="pdivid" id="pdivid" value="">
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" onclick="deleteProducer()" class="btn btn-outline">Delete</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<script type="text/javascript">
	
  function callTinymce(selecter){ 
  console.log(selecter);	
   tinymce.init({  
    selector: selecter,
    theme: "modern",
    paste_data_images: true,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    toolbar2: "print preview media | forecolor backcolor emoticons",
    image_advtab: true,
    //images_upload_url: '../images/pages_img',
    //file_picker_types: 'image',
    //automatic_uploads: true,
    /*images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '../images/pages_img');
            var token = $("input[name='_token']").val();
            xhr.setRequestHeader("X-CSRF-Token", token);
            xhr.onload = function() {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                $("#imagename").val(json.location);
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },*/
    file_picker_callback: function(callback, value, meta) {
      if (meta.filetype == 'image') {
        $('#upload').trigger('click');
        $('#upload').on('change', function() {
          var file = this.files[0];
          console.log(file);
          var reader = new FileReader();
          reader.onload = function(e) {
            callback(e.target.result, {
              alt: ''
            });
          };
          reader.readAsDataURL(file);
        });
      }
    },
    templates: [{
      title: 'Test template 1',
      content: 'Test 1'
    }, {
      title: 'Test template 2',
      content: 'Test 2'
    }]
  });
}
callTinymce('#editor1');
<?php if(isset($content)){ 
  foreach ($content as $key => $value) { ?>
      callTinymce('#editor'+<?php echo $key+1; ?>);
 <?php } ?> 
 $("#blockcount").val(<?php echo count($content); ?>); 
<?php } ?>   

	$(".btn-copy").on('click', function(){

	  $("#blockcount").val(parseInt($("#blockcount").val())	+ 1);		
	  var $div = $('div[id^="addnew"]:last');
	  var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
	  var $klon = $div.clone().prop('id', 'addnew'+num );
	  $klon.find(".mce-tinymce").remove();
	  $klon.find(".removebtn").remove();
	  $klon.find("#producer_name"+(num-1)).prop('name','producer_name'+num);
	  $klon.find("#producer_name"+(num-1)).prop('id','producer_name'+num);
	  
	  $klon.find("#producer_images"+(num-1)).prop('name','producer_images'+num+'[]');
	  $klon.find("#producer_images"+(num-1)).prop('id','producer_images'+num);

	  $klon.find("#producer_pdf_file"+(num-1)).prop('name','producer_pdf_file'+num);
	  $klon.find("#producer_pdf_file"+(num-1)).prop('id','producer_pdf_file'+num);

	  $klon.find("#producer_name"+num).val('');
	  $klon.find("#producer_images"+num).val('');
	  $klon.find("#producer_pdf_file"+num).val('');
    $klon.find("#producer_id"+(num-1)).remove();

	  var html='<div class="col-md-2 col-sm-2 col-lg-2">'+
                '<div class="removebtn pad">'+
	            		'<button type="button" class="btn btn-info btn-sm"' +
	            		 'title="" onclick=removediv('+num+')>'+
                  		'<i class="fa fa-times"></i></button>'+
                      '</div>'+
                  		'</div>';
    console.log(html);                  
	  $klon.find("#producer_pdf_file"+num).closest(".closebtn").after(html);
	  

	  $klon.find('#editor'+(num-1)).prop('name','editor'+num);
	  $klon.find('#editor'+(num-1)).prop('id','editor'+num);
    $klon.find("#editor"+num).val('');
    $klon.find(".diamond-uploaded-img").remove();
    $klon.find(".remove-file").remove();
	  $div.after( $klon );	
	   
	  callTinymce('#editor'+num);
	  $(".mce-tinymce").show();
  });

	function removediv(divid){
    $("#producerid").val($("#producer_id"+divid).val());
    $("#pdivid").val(divid);
    $("#modal-danger").modal('show');
		//$("#blockcount").val(parseInt($("#blockcount").val())	- 1);		
    //$("#addnew"+divid).hide('slow', function(){ $("#addnew"+divid).remove(); });
    
	}
  function deleteProducer(){
    $("#modal-danger").modal('hide');
    var pid=$("#producerid").val();
    var divid=$("#pdivid").val();
    if(pid!=""){
      $.ajax({
        url:"../content/deleteProducer",
        type:"get",
        data:"id="+pid,
        success:function(res){
          var html='<div class="alert alert-success alert-dismissible">'+
               '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
               'Producer Deleted successfully.!!'  
              '</div>';
          $(".content-wrapper").prepend(html);    
          $("#blockcount").val(parseInt($("#blockcount").val()) - 1);   
          $("#addnew"+divid).hide('slow', function(){ $("#addnew"+divid).remove(); });    
        }
      });
     }else{
          $("#blockcount").val(parseInt($("#blockcount").val()) - 1);   
          $("#addnew"+divid).hide('slow', function(){ $("#addnew"+divid).remove(); });    
     } 
    
  }

  $('.delete-pimage').click(function () {

        $(this).parent().parent().fadeOut('slow');
    });
  </script>
@endsection