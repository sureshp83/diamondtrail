@extends('adminlte::layouts.app')
@section('contentheader_title','Edit Trading Homepage Content')
@section('main-content')
<div class="box box-primary admin">
<form role="form" method="post" id="adminedituser" name="adminedituser" action="{{URL::to('/admin/content/public-home')}}" enctype="multipart/form-data">
{{csrf_field()}}
<input type="hidden" name="content_id" id="content_id" value="{{(isset($content->id) ? $content->id:'')}}">
<div class="box-header with-border">
     <h3 class="box-title">Page Detail</h3>
</div>
<div class="box-body">
  			<div class="row">	
          		<div class="col-lg-4 col-sm-6 col-md-4">
          		  <div class="form-group">	
		          		<lable for="title">Title</lable>
		          		<input type="text" name="block_title" id="block_title" class="form-control" value="{{(isset($content->block_title) ? $content->block_title:'')}}">
          		  </div>
          		</div>
          		<div class="col-lg-4 col-sm-6 col-md-4">
          		  <div class="form-group">	
		          		<lable for="title">Image</lable>
		          		<input type="file" name="block_image" id="block_image" class="form-control" onchange="readURL(this);">
          		  </div>
          		</div>
          	</div>

          	<div class="row">
          		<div class="col-md-12 col-sm-12 col-lg-12">
          			<lable for="content">Page Content</lable>
			            <!-- /.box-header -->
            
                    <textarea id="editor1" name="editor1" rows="10" cols="80">
                        {{(isset($content->block_content) ? $content->block_content:'')}}              
                    </textarea>
                     <input name="image" type="file" id="upload" class="hidden" onchange="">
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
</form>
</div>      <!-- ./row -->
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
    file_picker_callback: function(callback, value, meta) {
      if (meta.filetype == 'image') {
        $('#upload').trigger('click');
        $('#upload').on('change', function() {
          var file = this.files[0];
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
    

function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blockimg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }	

</script>
@endsection