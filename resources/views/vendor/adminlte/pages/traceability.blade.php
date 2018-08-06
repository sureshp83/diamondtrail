@extends('adminlte::layouts.app')
@section('contentheader_title','Edit Traceability Program Content')
@section('main-content')
<div class="box box-primary admin">
<form role="form" method="post" id="adminedituser" name="adminedituser" action="{{URL::to('/admin/content/traceability')}}" enctype="multipart/form-data">
{{csrf_field()}}
<input type="hidden" name="content_id" id="content_id" value="{{(isset($content[0]->id) ? $content[0]->id:'')}}">
<div class="box-header with-border">
     <h3 class="box-title">Page Detail</h3>
</div>

<div class="box-body">
  			<div class="row">	
  				<div class="col-md-12 col-sm-12 col-lg-12">
          			<lable for="content">Page Content</lable>
			            <!-- /.box-header -->
            
                    <textarea id="editor1" name="editor1" rows="10" cols="80">
                        {{(isset($content[0]->block_content) ? $content[0]->block_content:'')}}              
                    </textarea>
                     <input name="image" type="file" id="upload" class="hidden" onchange="">
                     <input type="hidden" name="imagename" id="imagename" value="">
          <!-- /.box -->
        		</div>
        		</div>
          	<hr>
          	
          	<div class="row">
          		<div class="col-md-2 col-sm-6 col-lg-2">
          		<a href="{{URL::to('admin/dashboard')}}" class="btn btn-block btn-default">Back</a>
          		</div>
          		<div class="col-md-2 col-sm-6 col-lg-2">
          			<button type="submit" class="btn btn-block btn-primary">Save</button>
          		</div>
          	</div>	 
</div>
</div>  			
</form>
</div>
<script type="text/javascript">
	$(function () {
  tinymce.init({  
    selector: "textarea",
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
    images_upload_handler: function (blobInfo, success, failure) {
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
        },
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
  });
  </script>
@endsection