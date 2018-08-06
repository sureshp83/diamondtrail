jQuery(function($) {


    setTimeout(function(){
        $(".alert-message").fadeOut();
    }, 2000);

    $("#type_of_company").on("change",function(){
        if($(this).val() == 6){
            $(".othertypecomp").show(); 
        }else{
            $(".othertypecomp").hide(); 
        }
    });
    $("#s_type_of_company").on("change",function(){
        if($(this).val() == 6){
            $(".sothertypecomp").show(); 
        }else{
            $(".sothertypecomp").hide(); 
        }
    });

    $(".uploaded-file .remove-file").click(function(){
        if(confirm("Are you sure want to delete certificate ?")){
            $(this).siblings('.filedata').val(null);
        }
    });
 $("#country_id").on('change',function(){
     $.ajax({
        url:"../loadprovince",
        data:'id='+$(this).val(),
        type:"GET",
        success:function(response){
            var bodyhtml="<option value=''>Please Select</option>";
           response.province.forEach(function(entry){
               bodyhtml+='<option value="'+entry.id+'">'+entry.name+'</option>';
           });
           $("#province_id").html(bodyhtml);
        }
    });
 });

 //admin 
 $(".admin #country_id").on('change',function(){
     $.ajax({
        url:"../../../loadprovince",
        data:'id='+$(this).val(),
        type:"GET",
        success:function(response){
            var bodyhtml="<option value=''>Please Select</option>";
           response.province.forEach(function(entry){
               bodyhtml+='<option value="'+entry.id+'">'+entry.name+'</option>';
           });
           $("#province_id").html(bodyhtml);
        }
    });
 });

    $("#s_country_id").on('change',function(){
        $.ajax({
            url:"../loadprovince",
            data:'id='+$(this).val(),
            type:"GET",
            success:function(response){
                var bodyhtml="<option value=''>Please Select</option>";
                response.province.forEach(function(entry){
                    bodyhtml+='<option value="'+entry.id+'">'+entry.name+'</option>';
                });
                $("#s_province_id").html(bodyhtml);
            }
        });
    });

    if($("#province_id").attr("data-value")!=""){
    $.ajax({
        url:"../loadprovince",
        data:'id='+$("#country_id").val(),
        type:"GET",
        success:function(response){
            var bodyhtml="<option value=''>Please Select</option>";
           response.province.forEach(function(entry){
               bodyhtml+='<option value="'+entry.id+'" '+(($("#province_id").attr("data-value")==entry.id)?"selected":"")+'>'+entry.name+'</option>';
           });
           $("#province_id").html(bodyhtml);
        }
    });

   }

   //admin
   if($(".admin #province_id").attr("data-value")!=""){
    $.ajax({
        url:"../../../loadprovince",
        data:'id='+$("#country_id").val(),
        type:"GET",
        success:function(response){
            var bodyhtml="<option value=''>Please Select</option>";
           response.province.forEach(function(entry){
               bodyhtml+='<option value="'+entry.id+'" '+(($("#province_id").attr("data-value")==entry.id)?"selected":"")+'>'+entry.name+'</option>';
           });
           $("#province_id").html(bodyhtml);
        }
    });

   }

   if($("#s_province_id").attr("data-value")!=""){
    $.ajax({
        url:"../loadprovince",
        data:'id='+$("#s_country_id").val(),
        type:"GET",
        success:function(response){
            var bodyhtml="<option value=''>Please Select</option>";
           response.province.forEach(function(entry){
               bodyhtml+='<option value="'+entry.id+'" '+(($("#s_province_id").attr("data-value")==entry.id)?"selected":"")+'>'+entry.name+'</option>';
           });
           $("#s_province_id").html(bodyhtml);
        }
    });

   } 
   
    $(".radio-confirm .radio-input").change(function(){
        if($(this).is(":checked")) {
            $("#register_btn").removeClass("disabled");
            $("#register_btn").attr("type","submit");
        }else{
            $("#register_btn").addClass("disabled");
            $("#register_btn").attr("type","button");
        }


    });
    $("input[type='file'][name='diamond_certi_file']").change(function(){
        $("#remove-seller-Dfile").remove();
        var filename=$(this).val().split("fakepath");
        filename=filename[1].substring(1);
        appendhtml='<a href="javascript:void(0);" onclick="deletesellerDCer()" id="remove-seller-Dfile" class="remove-file">'+filename+'</a>';
        $(this).after(appendhtml);
    });

    $("input[type='file'][name='incorporation_certificate']").change(function(){
        $("#remove-file-inc").remove();
        var filename=$(this).val().split("fakepath");
        filename=filename[1].substring(1);
       appendhtml='<br><a href="javascript:void(0);" onclick="deleteCertificateFile()" id="remove-file-inc" class="remove-file">'+filename+'</a>';
       $(this).after(appendhtml);
    });

    $("input[type='file'][name='memorandom_certificate']").change(function(){
        $("#remove-file-mem").remove();
        var filename=$(this).val().split("fakepath");
        filename=filename[1].substring(1);
        appendhtml='<br><a href="javascript:void(0);" onclick="deleteMemCertificateFile()" id="remove-file-mem" class="remove-file">'+filename+'</a>';
        $(this).after(appendhtml);
    });

    $("input[type='file'][name='s_incorporation_certificate']").change(function(){
        $("#remove-file-sinc").remove();
        var filename=$(this).val().split("fakepath");
        filename=filename[1].substring(1);
        appendhtml='<br><a href="javascript:void(0);" onclick="deleteSCertificateFile()" id="remove-file-sinc" class="remove-file">'+filename+'</a>';
        $(this).after(appendhtml);
    });

    $("input[type='file'][name='s_memorandom_certificate']").change(function(){
        $("#remove-file-smem").remove();
        var filename=$(this).val().split("fakepath");
        filename=filename[1].substring(1);
        appendhtml='<br><a href="javascript:void(0);" onclick="deleteSMemCertificateFile()" id="remove-file-smem" class="remove-file">'+filename+'</a>';
        $(this).after(appendhtml);
    });

    $("input[type='file'][name='acc_rlc_certificate']").change(function(){
        $("#remove-file-acc_rlc").remove();
        var filename=$(this).val().split("fakepath");
        filename=filename[1].substring(1);
        appendhtml='<br><a href="javascript:void(0);" onclick="deleteAccRlcCertificate()" id="remove-file-acc_rlc" class="remove-file">'+filename+'</a>';
        $(this).after(appendhtml);
    });

    $("input[type='file'][name='acc_prov_certificate']").change(function(){
        $("#remove-file-acc_prov").remove();
        var filename=$(this).val().split("fakepath");
        filename=filename[1].substring(1);
        appendhtml='<br><a href="javascript:void(0);" onclick="deleteAccProvCertificate()" id="remove-file-acc_prov" class="remove-file">'+filename+'</a>';
        $(this).after(appendhtml);
    });


    $('#register-as-a-buyer-and-seller #same-info').change(function() {

        if($(this).is(":checked")) {

                $.ajax({
                    url:"../loadprovince",
                    data:'id='+$("#country_id").val(),
                    async: false,
                    type:"GET",
                    success:function(response){
                        var bodyhtml="";
                        response.province.forEach(function(entry){
                            bodyhtml+='<option value="'+entry.id+'">'+entry.name+'</option>';
                        });
                        $("#s_province_id").html(bodyhtml);
                    }
                });

            $(this).attr("checked", true);
            $("#s_company_name").val($("#company_name").val());
            $("#s_company_name").attr("readonly",true);
            $("#s_company_address_1").val($("#company_address_1").val());
            $("#s_company_address_1").attr("readonly",true);
            $("#s_company_address_2").val($("#company_address_2").val());
            $("#s_company_address_2").attr("readonly",true);
            $("#s_city").val($("#city").val());
            $("#s_city").attr("readonly",true);
            $("#s_country_id").val($("#country_id").val());
            $("#s_country_id").attr("readonly",true);
            $("#s_province_id").val($("#province_id").val());
            $("#s_province_id").attr("readonly",true);
            $("#s_postal_code").val($("#postal_code").val());
            $("#s_postal_code").attr("readonly",true);
            $("#s_company_phone").val($("#company_phone").val());
            $("#s_company_phone").attr("readonly",true);
            $("#s_company_web").val($("#company_web").val());
            $("#s_company_web").attr("readonly",true);
            $("#s_type_of_company").val($("#type_of_company").val());
            $("#s_type_of_company").attr("readonly",true);
            $("#s_other_type").val($("#other_type").val());
            $("#s_other_type").attr("readonly",true);
            if($("#type_of_company").val()=="6"){
               $(".sothertypecomp").show(); 
            }else{
               $(".sothertypecomp").hide();  
            }

            $("#s_username").val($("#username").val());
            $("#s_username").attr("readonly",true);
            $("#s_password").val($("#password").val());
            $("#s_password").attr("readonly",true);
            $("#s_first_name").val($("#first_name").val());
            $("#s_first_name").attr("readonly",true);
            $("#s_last_name").val($("#last_name").val());
            $("#s_last_name").attr("readonly",true);
            $("#s_email").val($("#email").val());
            $("#s_email").attr("readonly",true);
            $("#s_position").val($("#position").val());
            $("#s_position").attr("readonly",true);
            $("#selleraccount .company-documentation").addClass("content-disable");
            $("#s_incorporation_certificate").attr("disabled",true);
            $("#s_memorandom_certificate").attr("disabled",true);
        }else{
            $(this).attr("checked", false);
            $("#s_company_name").val('');
            $("#s_company_name").attr("readonly",false);
            $("#s_company_address_1").val('');
            $("#s_company_address_1").attr("readonly",false);
            $("#s_company_address_2").val('');
            $("#s_company_address_2").attr("readonly",false);
            $("#s_city").val('');
            $("#s_city").attr("readonly",false);
            $("#s_country_id").val('');
            $("#s_country_id").attr("readonly",false);
            $("#s_province_id").val('');
            $("#s_province_id").attr("readonly",false);
            $("#s_postal_code").val('');
            $("#s_postal_code").attr("readonly",false);
            $("#s_company_phone").val('');
            $("#s_company_phone").attr("readonly",false);
            $("#s_company_web").val('');
            $("#s_company_web").attr("readonly",false);
            $("#s_type_of_company").val('');
            $("#s_type_of_company").attr("readonly",false);
            $("#s_other_type").val('');
            $("#s_other_type").attr("readonly",false);
            $("#s_username").val('');
            $("#s_username").attr("readonly",false);
            $("#s_password").val('');
            $("#s_password").attr("readonly",false);
            $("#s_first_name").val('');
            $("#s_first_name").attr("readonly",false);
            $("#s_last_name").val('');
            $("#s_last_name").attr("readonly",false);
            $("#s_email").val('');
            $("#s_email").attr("readonly",false);
            $("#s_position").val('');
            $("#s_position").attr("readonly",false);
        }

    });

    // Wait for the DOM to be ready
    $(function() {

        //contact us
        $("form[name='contactus']").validate({
            //debug: true,
            rules:{
                company_name:'required',
                full_name:'required',
                email: {
                    required: true,
                    email: true
                },
                phone_no:'required',
                subject:'required',
                message:'required'
            },
            messages:{
                company_name:'Please enter company name.',
                full_name:'Please enter your full name.',
                email: {
                    required:"Please enter email address",
                    email:"Please enter a valid email address",
                },
                phone_no:'Please enter your phone no.',
                subject:'Please enter subject.',
                message:'Please enter your message.'
            },
            submitHandler:function(form){
                form.submit();
            }
        });


        // buyer register

        $("form[name='buyerreg']").validate({
            // Specify validation
            //errorElement: 'span',
            //debug: true,
            rules: {
                company_name: "required",
                company_address_1: "required",
                city: "required",
                country_id: "required",
                province_id: "required",
                postal_code: {
                    required: true,
                    minlength: 6
                },
                company_phone: "required",
                first_name: "required",
                last_name: "required",
                email: {
                    required: true,
                    email: true,
                    remote: "/register/check_email_unique"
                },
                username: {
                    required:true,
                    remote: '/register/check_username_unique',  
                },
                password: {
                    required: true,
                    minlength: 6
                },
                incorporation_certificate:'required',
                memorandom_certificate:'required',
                is_agree:'required',
            },
            messages: {
                company_name:"Please enter your company name",
                company_address_1:"Please enter your company address",
                city:"Please enter city name",
                country_id:"Please select country",
                province_id:"Please select province",
                postal_code:{
                    required: "Please enter postal code",
                    minlength: "Your postal code must be at least 6 characters long"
                },
                company_phone:"Please enter company phone",
                first_name: "Please enter your firstname",
                last_name: "Please enter your lastname",
                username:{
                    required:"Please enter your username",
                    remote:"The username has already been taken."
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                email: {
                    required:"Please enter email address",
                    email:"Please enter a valid email address",
                    remote: "The email has already been taken."
                },
                incorporation_certificate:"Please select incorporation certificate file.",
                memorandom_certificate:"Please select memorandom certificate file.",
                is_agree:"Please agree with terms & condition.",
            },
            submitHandler: function (form) {

                form.submit();
            }
        });


        // seller register

        $("form[name='sellerreg']").validate({
            // Specify validation
            //errorElement: 'span',
            rules: {
                company_name: "required",
                company_address_1: "required",
                city: "required",
                country_id: "required",
                province_id: "required",
                postal_code: {
                    required: true,
                    minlength: 6
                },
                company_phone: "required",
                first_name: "required",
                last_name: "required",
                email: {
                    required: true,
                    email: true,
                    remote: "/register/check_email_unique"
                },
                username: {
                    required:true,
                    remote: '/register/check_username_unique',  
                },
                password: {
                    required: true,
                    minlength: 6
                },
                incorporation_certificate:'required',
                memorandom_certificate:'required',
                acc_rlc_certificate:'required',
                acc_prov_certificate:'required',
                is_agree:'required',
            },
            messages: {
                company_name:"Please enter your company name",
                company_address_1:"Please enter your company address",
                city:"Please enter city name",
                country_id:"Please select country",
                province_id:"Please select province",
                postal_code:{
                    required: "Please enter postal code",
                    minlength: "Your postal code must be at least 6 characters long"
                },
                company_phone:"Please enter company phone",
                first_name: "Please enter your firstname",
                last_name: "Please enter your lastname",
                username:{
                    required:"Please enter your username",
                    remote:"The username has already been taken."
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                email: {
                    required:"Please enter email address",
                    email:"Please enter a valid email address",
                    remote: "The email has already been taken."
                },
                incorporation_certificate:"Please select incorporation certificate file.",
                memorandom_certificate:"Please select memorandom certificate file.",
                acc_rlc_certificate:"Please select RLC certificate.",
                acc_prov_certificate:"Please select provenance claim.",
                is_agree:"Please agree with terms & condition.",
            },
            submitHandler: function (form) {

                form.submit();
            }
        });


        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        $("form[name='buyer&seller']").validate({
            // Specify validation
            //errorElement: 'span',
            rules: {
                company_name:"required",
                company_address_1:"required",
                city:"required",
                country_id:"required",
                province_id:"required",
                postal_code:{
                    required: true,
                    minlength: 6
                },
                company_phone: "required",
                first_name: "required",
                last_name: "required",
                email: {
                    required: true,
                    email: true,
                    remote: "/register/check_email_unique"
                },
                username: {
                    required:true,
                    remote: '/register/check_username_unique',  
                },
                password: {
                    required: true,
                    minlength: 6
                },

                incorporation_certificate:'required',
                memorandom_certificate:'required',

                s_company_name:"required",
                s_company_address_1:"required",
                s_city:"required",
                s_country_id:"required",
                s_province_id:"required",
                s_postal_code:{
                    required: true,
                    minlength: 6
                },
                s_company_phone: "required",
                s_first_name: "required",
                s_last_name: "required",
                s_email: {
                    required: true,
                    email: true,
                    remote: "/register/check_email_unique"
                },
                s_username: {
                    required:true,
                    remote: '/register/check_username_unique',  
                },
                s_password: {
                    required: true,
                    minlength: 6
                },
                s_incorporation_certificate:'required',
                s_memorandom_certificate:'required',
                acc_rlc_certificate:'required',
                acc_prov_certificate:'required',
            },
            // Specify validation error messages
            messages: {
                company_name:"Please enter your company name",
                company_address_1:"Please enter your company address",
                city:"Please enter city name",
                country_id:"Please select country",
                province_id:"Please select province",
                postal_code:{
                    required: "Please enter postal code",
                    minlength: "Your postal code must be at least 6 characters long"
                },
                company_phone:"Please enter company phone",
                first_name: "Please enter your firstname",
                last_name: "Please enter your lastname",
                username:{
                    required:"Please enter your username",
                    remote:"The username has already been taken."
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                email: {
                    required:"Please enter email address",
                    email:"Please enter a valid email address",
                    remote: "The email has already been taken."
                },

                incorporation_certificate:"Please select incorporation certificate file.",
                memorandom_certificate:"Please select memorandom certificate file.",

                s_company_name:"Please enter your company name",
                s_company_address_1:"Please enter your company address",
                s_city:"Please enter city name",
                s_country_id:"Please select country",
                s_province_id:"Please select province",
                s_postal_code:{
                    required: "Please enter postal code",
                    minlength: "Your postal code must be at least 6 characters long"
                },
                s_company_phone:"Please enter company phone",
                s_first_name: "Please enter your firstname",
                s_last_name: "Please enter your lastname",
                s_username:{
                    required:"Please enter your username",
                    remote:"The username has already been taken."
                },
                s_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                s_email:{
                    required:"Please enter email address",
                    email:"Please enter a valid email address",
                    remote: "The email has already been taken."
                },
                s_incorporation_certificate:"Please select incorporation certificate file.",
                s_memorandom_certificate:"Please select memorandom certificate file.",
                acc_rlc_certificate:"Please select RLC certificate.",
                acc_prov_certificate:"Please select provenance claim.",
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            invalidHandler: function(form, validator) {
                console.log($(this).find(".company-information .form-group #company_name-error"));
                if ($(this).find(".company-information .form-group #company_name-error")) {
                    console.log('test');
                    $(this).closest("form-group").addClass("has-error");
                }
            },
            submitHandler: function(form) {

                form.submit();
            }
        });
        
        //~ $("input#diamond_images").on('change', function() {
			//~ $('label#diamond_images-error').css('display','none');
		//~ });

        $("form[name='sellerpostdiamondstep1']").validate({
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
        /*$("#btnstep-1").click(function(){

            if($("input[type=file][name='diamond_certi_file']").val()=="" || $("input[type=file][name='diamond_certi_file']").attr("value")==""){
                $("input[type=file][name='diamond_certi_file']").addClass("error");
                var errorhtml='<label id="diamond_certi_file-error" class="error" for="diamond_certi_file">Please select certificate.</label>';
                $("input[type=file][name='diamond_certi_file']").after(errorhtml);
            }

            if($("input[type=file][name='diamond_images[]']").val()==""){
                $("input[type=file][name='diamond_images[]']").addClass("error");
                var errorhtml='<label id="diamond_images-error" class="error" for="diamond_images">Please select at least 1 image.</label>';
                $("input[type=file][name='diamond_images[]']").next(".custom-file-label").after(errorhtml);
            }
        });*/

    });
        
    $("form[name='adminedituser']").validate({

        rules: {
            first_name:'required',
            last_name:'required',
            company_name:'required',
            company_address_1:'required',
            company_address_2:'required',
            country_id:'required',
            province_id:'required',
            city:'required',
            postal_code:'required',
            company_phone:'required',
            incorporation_certificate:{
                    required: function(){
                        return $("#incorporation_certificate").attr("data-value")=="";
                    }
                },
            //incorporation_certificate:'required',
            memorandom_certificate:{
                    required: function(){
                        return $("#memorandom_certificate").attr("data-value")=="";
                    }
                },
            acc_rlc_certificate:{
                    required: function(){
                        return $("#acc_rlc_certificate").attr("data-value")=="";
                    }
            },
            acc_prov_certificate:{
                    required: function(){
                        return $("#acc_prov_certificate").attr("data-value")=="";
                    }  
            }    
        },
        messages: {
            first_name:"Please enter first name.",
            last_name:"Please enter last name.",
            company_name:"Please enter company name.",
            company_address_1:"please enter company address.",
            company_address_2:"please enter company address.",
            country_id:"Please select country.",
            province_id:"Please select province.",
            city:"Please enter city.",
            postal_code:"Please enter postal code.",
            company_phone:"Please enter company phone.",
            incorporation_certificate:"Please select incorporation certificate file.",
            memorandom_certificate:"Please select memorandom certificate file.",
            acc_rlc_certificate:"Please select RLC certificate.",
            acc_prov_certificate:"Please select provenance claim.",

        },
        submitHandler: function (form) {

            form.submit();
        }
    });        

    $("form[name='buyerpostdiamondstep1']").validate({

        // Specify validation
        //errorElement: 'span',
       // debug:true,
        rules: {
            'country_id[]':'required',
            'mine_id[]':'required',
            'producer_id[]':'required',
            price:'required',
            totalprice:'required',
            shape_id:'required',
            carat_min:'required',
            carat_max:'required',
            'brand_id[]':'required',
            'certification_laboratories_id[]':'required',
        },
        messages: {
            'country_id[]':"Please select country of origin.",
            'mine_id[]':"Please select mine of origin.",
            'producer_id[]':"Please select producer of origin.",
            price:"please enter price.",
            totalprice:"Please enter total price.",
            shape_id:"Please select shape.",
            carat_min:"Please enter min carat.",
            carat_max:"Please enter max carat.",
            'brand_id[]':"Please select brand.",
            'certification_laboratories_id[]':"Please select certification laboratories.",
        },
        submitHandler: function (form) {

            form.submit();
        }
    });

    $(".diamond_details .diamond-shapes .single-shape").click(function(){
        $(this).find('input[type=radio][name=shape_id]').prop("checked", true);
        $(".diamond-shapes").find(".single-shape").removeClass("active");
            if($(this).find('input[type=radio][name=shape_id]').is(':checked')){

                $(this).closest(".single-shape").addClass("active");
            }
    });


    /*$("#register-as-a-buyer-and-seller #register_btn").click(function(e) {

        if ($("#buyersellerreg").hasClass("error")) {
            console.log('test');
            $(this).closest("form-group").addClass("has-error");
        }
    });*/
    /*$("#register-as-a-buyer-and-seller #register_btn").click(function(e){
        e.preventDefault();
        if(!$(this).hasClass("disabled")){
           //buyer panel

            if($("#company_name").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The company name field is required.</strong>\n' +
                    '</span>';
                $("#company_name").closest(".form-group").addClass("has-error");
                $("#company_name").after(errorhtml);
                return false;
            }else{
                $("#company_name").closest(".form-group").removeClass("has-error");
                $("#company_name").next('span').remove();
            }
            if($("#company_address_1").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The company address 1 field is required.</strong>\n' +
                    '</span>';
                $("#company_address_1").closest(".form-group").addClass("has-error");
                $("#company_address_1").after(errorhtml);
                return false;
            }else{
                $("#company_address_1").closest(".form-group").removeClass("has-error");
                $("#company_address_1").next('span').remove();
            }
            if($("#city").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The city field is required.</strong>\n' +
                    '</span>';
                $("#city").closest(".form-group").addClass("has-error");
                $("#city").after(errorhtml);
                return false;
            }else{
                $("#city").closest(".form-group").removeClass("has-error");
                $("#city").next('span').remove();
            }
            if($("#country_id").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The country id field is required.</strong>\n' +
                    '</span>';
                $("#country_id").closest(".form-group").addClass("has-error");
                $("#country_id").after(errorhtml);
                return false;
            }else{
                $("#country_id").closest(".form-group").removeClass("has-error");
                $("#country_id").next('span').remove();
            }
            if($("#province_id").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The province id field is required.</strong>\n' +
                    '</span>';
                $("#province_id").closest(".form-group").addClass("has-error");
                $("#province_id").after(errorhtml);
                return false;
            }else{
                $("#province_id").closest(".form-group").removeClass("has-error");
                $("#province_id").next('span').remove();
            }
            if($("#postal_code").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The postal code field is required.</strong>\n' +
                    '</span>';
                $("#postal_code").closest(".form-group").addClass("has-error");
                $("#postal_code").after(errorhtml);
                return false;
            }else{
                $("#postal_code").closest(".form-group").removeClass("has-error");
                $("#postal_code").next('span').remove();
            }

            if($("#company_phone").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The company phone field is required.</strong>\n' +
                    '</span>';
                $("#company_phone").closest(".form-group").addClass("has-error");
                $("#company_phone").after(errorhtml);
                return false;
            }else{
                $("#company_phone").closest(".form-group").removeClass("has-error");
                $("#company_phone").next('span').remove();
            }
            if($("#username").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The username field is required.</strong>\n' +
                    '</span>';
                $("#username").closest(".form-group").addClass("has-error");
                $("#username").after(errorhtml);
                return false;
            }else{
                $("#username").closest(".form-group").removeClass("has-error");
                $("#username").next('span').remove();
            }
            if($("#password").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The password field is required.</strong>\n' +
                    '</span>';
                $("#password").closest(".form-group").addClass("has-error");
                $("#password").after(errorhtml);
                return false;
            }else{
                $("#password").closest(".form-group").removeClass("has-error");
                $("#password").next('span').remove();
            }
            if($("#first_name").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The first name field is required.</strong>\n' +
                    '</span>';
                $("#first_name").closest(".form-group").addClass("has-error");
                $("#first_name").after(errorhtml);
                return false;
            }else{
                $("#first_name").closest(".form-group").removeClass("has-error");
                $("#first_name").next('span').remove();
            }
            if($("#last_name").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The last name field is required.</strong>\n' +
                    '</span>';
                $("#last_name").closest(".form-group").addClass("has-error");
                $("#last_name").after(errorhtml);
            }else{
                $("#last_name").closest(".form-group").removeClass("has-error");
                $("#last_name").next('span').remove();
            }
            if($("#email").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The email field is required.</strong>\n' +
                    '</span>';
                $("#email").closest(".form-group").addClass("has-error");
                $("#email").after(errorhtml);
            }else{

                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!regex.test($("#email").val())){
                    errorhtml='<span class="help-block">\n' +
                        '<strong>The email format is not valid.</strong>\n' +
                        '</span>';
                    $("#email").closest(".form-group").addClass("has-error");
                    $("#email").after(errorhtml);
                }else{
                    $("#email").closest(".form-group").removeClass("has-error");
                    $("#email").next('span').remove();
                }
            }

           //seller panel

           if($("#s_company_name").val() == ""){
               errorhtml='<span class="help-block">\n' +
                            '<strong>The company name field is required.</strong>\n' +
                         '</span>';
               $("#s_company_name").closest(".form-group").addClass("has-error");
               $("#s_company_name").after(errorhtml);
           }
            if($("#s_company_address_1").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The company address 1 field is required.</strong>\n' +
                    '</span>';
                $("#s_company_address_1").closest(".form-group").addClass("has-error");
                $("#s_company_address_1").after(errorhtml);
            }
            if($("#s_city").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The city field is required.</strong>\n' +
                    '</span>';
                $("#s_city").closest(".form-group").addClass("has-error");
                $("#s_city").after(errorhtml);
            }
            if($("#s_country_id").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The country id field is required.</strong>\n' +
                    '</span>';
                $("#s_country_id").closest(".form-group").addClass("has-error");
                $("#s_country_id").after(errorhtml);
            }
            if($("#s_province_id").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The province id field is required.</strong>\n' +
                    '</span>';
                $("#s_province_id").closest(".form-group").addClass("has-error");
                $("#s_province_id").after(errorhtml);
            }
            if($("#s_postal_code").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The postal code field is required.</strong>\n' +
                    '</span>';
                $("#s_postal_code").closest(".form-group").addClass("has-error");
                $("#s_postal_code").after(errorhtml);
            }

            if($("#s_company_phone").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The company phone field is required.</strong>\n' +
                    '</span>';
                $("#s_company_phone").closest(".form-group").addClass("has-error");
                $("#s_company_phone").after(errorhtml);
            }
            if($("#s_username").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The username field is required.</strong>\n' +
                    '</span>';
                $("#s_username").closest(".form-group").addClass("has-error");
                $("#s_username").after(errorhtml);
            }
            if($("#s_password").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The password field is required.</strong>\n' +
                    '</span>';
                $("#s_password").closest(".form-group").addClass("has-error");
                $("#s_password").after(errorhtml);
            }
            if($("#s_first_name").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The first name field is required.</strong>\n' +
                    '</span>';
                $("#s_first_name").closest(".form-group").addClass("has-error");
                $("#s_first_name").after(errorhtml);
            }
            if($("#s_last_name").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The last name field is required.</strong>\n' +
                    '</span>';
                $("#s_last_name").closest(".form-group").addClass("has-error");
                $("#s_last_name").after(errorhtml);
            }
            if($("#s_email").val() == ""){
                errorhtml='<span class="help-block">\n' +
                    '<strong>The email field is required.</strong>\n' +
                    '</span>';
                $("#s_email").closest(".form-group").addClass("has-error");
                $("#s_email").after(errorhtml);
            }else{

                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if(!regex.test($("#s_email").val())){
                    errorhtml='<span class="help-block">\n' +
                        '<strong>The email format is not valid.</strong>\n' +
                        '</span>';
                    $("#s_email").closest(".form-group").addClass("has-error");
                    $("#s_email").after(errorhtml);
                }
            }
        }
    });*/


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
    $("input[name='postdiamond']").on("click",function(e){
        $('#custom-alert-box').show();
        setTimeout(function () {
            $('#custom-alert-box .alert-box').addClass('show-alert');
        }, 100);

    });

    
    /*$('#diamond_images').fileupload({
        change : function (e, data) {
            if(data.files.length>4){
                errorhtml='<label id="diamond_images-error" class="error" for="diamond_images">Max 4 files are allowed.</label>';
                $(this).next(".custom-file-label").after(errorhtml);
                return false;
            }
            else
            {
                var files = $(this).get(0).files;
                console.log(files);
                return false;
                var names = [];
                for (var i = 0; i < $(this).get(0).files.length; ++i) {
                    names.push($(this).get(0).files[i].name);
                }
                errorhtml="";
                $(this).next(".custom-file-label").after(errorhtml);
                return true;
            }
        }
    });*/
    $("#diamond_images").change(function(){

        //finalFiles = {};
        var eximgc=$("#diamondimgCount").attr("data-value");
        
        $("#diamondimgCount").attr("data-value",parseInt(eximgc)+parseInt($(this).get(0).files.length));
        if($(this).get(0).files.length>4 || $("#diamondimgCount").attr("data-value") > 4){
            $(this).next('#diamond_images-error').remove();
            console.log(eximgc);
            $("#diamondimgCount").attr("data-value",eximgc);
            errorhtml='<div id="diamond_images-error" class="error" for="diamond_images">Please select maximum 4 image.</div>';
            $(this).after(errorhtml);
            return false;
        }else{
            if($("#diamondimgCount").attr("data-value") <= 4) {
				$('label#diamond_images-error').css('display','none');
                $("#diamondimgCount").next(".custom-file").show();
                $('.remove-imgfile').remove();
                appendhtml = '';
                for (var i = 0; i < $(this).get(0).files.length; ++i) {
                    appendhtml='<a href="javascript:void(0);" id="remove-seller-imgs'+[i]+'" class="remove-imgfile">'+$(this).get(0).files[i].name+'</a>';
                    $(this).after(appendhtml);
                }
                var files = $(this).get(0).files;
                /*$.each(this.files,function(idx,elm){
                    finalFiles[idx]=elm;
                });*/
                console.log(files);
                var firstFile = files.item(1);
                var idstokeep = [0, 2]; // keep first `2` files from `multiple` selection
                var _files = Array.prototype.slice.call(files).splice(idstokeep[0], idstokeep[1]);
            }else{
                //$("#diamondimgCount").find(".custom-file").hide();
            }
            /*console.log(files, files.length
                , _files, _files.length
                , firstFile);*/
            //$("input[name='diamond_images[]']").val(files);
        }
        /*for (var i = 0; i < $(this).get(0).files.length; ++i) {
            names.push($(this).get(0).files[i].name);
        }
        console.log(names);*/
    });

    $("#upload_csv_seller").change(function(){
        if(this.value != ''){
            var ext = this.value.match(/\.(.+)$/)[1];
            console.log( $(this).parent().parent().after());
            $('.remove-csvfile').remove();
            switch (ext) {
                case 'csv':

                    appendhtml='<a href="javascript:void(0);" class="remove-csvfile">'+$(this).get(0).files[0].name+'</a>';
                    $(this).parent().parent().after(appendhtml);
                    break;
                default:
                    errorhtml='<label id="diamond_images-error" class="error" for="diamond_images">This is not an allowed file type.</label>';
                    $(this).after(errorhtml);
                    this.value = '';
            }
        }
    });

    $("#upload_dmgimg_seller").change(function(){
        if(this.value != '') {
            var ext = this.value.substring(this.value.lastIndexOf(".")+1);
            console.log(ext);
            switch (ext) {
                case 'jpg':
                case 'jpeg':
                    $('.remove-imgfile').remove();
                    appendhtml = '';
                    var images = $(this)[0].files;

                    for(var i=0;i<= images.length - 1;i++){
                        appendhtml +='<a href="javascript:void(0);" class="remove-imgfile">'+images[i].name+'</a>';
                    }
                    $(this).parent().parent().after(appendhtml);
                    break;

                default:
                    errorhtml1 = '<label id="diamond_images-error1" class="error" for="diamond_images">This is not an allowed file type.</label>';
                    $(this).parent().parent().after(errorhtml1);
                    this.value = '';
            }
        }
    });

    $("input[type='file'][name='upload_dmgpdf_seller[]']").change(function(){
        var ext = this.value.substring(this.value.lastIndexOf(".")+1);
        console.log(ext);
        switch (ext) {
            case 'pdf':
                $('.remove-certfile').remove();
                appendhtml = '';
                var images = $(this)[0].files;

                for(var i=0;i<= images.length - 1;i++){
                    appendhtml +='<a href="javascript:void(0);" class="remove-certfile">'+images[i].name+'</a>';
                }
                $(this).parent().parent().after(appendhtml);
                break;

                break;
            default:
                errorhtml2='<label id="diamond_images-error2" class="error" for="diamond_images">This is not an allowed file type.</label>';
                $(this).parent().parent().after(errorhtml2);
                this.value = '';
        }
    });
	
	//$('div#uploaddmgimgseller').css('display','none');
	//$('div#uploaddmgpdfseller').css('display','none');
	
	$('input#btnstep-1').click(function(){

		$.ajax({
            url:"../seller/upload-csv-1",
            data:'id='+$(this).val(),
            type:"GET",
            success:function(response){
				$('div#uploaddmgimgseller').css('display','block');
				$('div#uploaddmgpdfseller').css('display','none');
				$('div#uploadcsvseller').css('display','none');
                var bodyhtml="";
                response.province.forEach(function(entry){
                    bodyhtml+='<option value="'+entry.id+'">'+entry.name+'</option>';
                });
                $("#s_province_id").html(bodyhtml);
            }
        });
        
	});
    
    $(".postDiamond").on("click",function(){
       console.log('erfe');
        $("input[name='postdiamond']").attr("type","submit");
        $("input[name='postdiamond']").click();
        closeAlert();
    });

    $(".delete-image").on("click",function(){
        $.ajax({
           url:"../deleteimg",
           data:'id='+$(this).attr("data-value"),
           type:"get",
           success:function(response){

           }
        });
    });
    $(".delete-pimage").on("click",function(){
        $.ajax({
           url:"../producer/deleteimg",
           data:'id='+$(this).attr("data-value"),
           type:"get",
           success:function(response){

           }
        });
    });
});




function closeAlert(){
    $('#custom-alert-box .alert-box').removeClass('show-alert');
    $('#custom-alert-box').hide();
}

function  deleteCertificateFile() {
    $("#certificate").val('');
    $("#incorporation_certificate").attr('data-value','');
    $("#remove-file-inc").remove();
}

function  deleteMemCertificateFile() {
    $("#association").val('');
    $("#memorandom_certificate").attr('data-value','');
    $("#remove-file-mem").remove();
}
function  deleteSCertificateFile() {
    $("#s_incorporation_certificate").val('');
    $("#remove-file-sinc").remove();
}
function  deleteSMemCertificateFile() {
    $("#s_memorandom_certificate").val('');
    $("#remove-file-smem").remove();
}
function  deleteAccRlcCertificate() {
    $("#acc_rlc_certificate").val('');
    $("#acc_rlc_certificate").attr('data-value','');
    $("#remove-file-acc_rlc").remove();
}
function  deleteAccProvCertificate() {
    $("#acc_prov_certificate").val('');
    $("#acc_prov_certificate").attr('data-value','');
    $("#remove-file-acc_prov").remove();
}

function RemoveProducerPdf(id){
    $.ajax({
           url:"../producer/deletepdf",
           data:'id='+$("#producer_id"+id).val(),
           type:"get",
           success:function(response){
            $("#producer_pdf_file"+id).attr('data-value','');
            $("#producer_pdffile"+id).remove();
           }
        });
    

}

function deletesellerDCer() {
    $("#post-a-diamond #diamond_certi_file").attr("value","");
    $("#remove-seller-Dfile").remove();
}

function deletesellerImg(obj){
    //$("#remove-seller-imgs"+imgid).remove();
    $("#diamond_images").val('');
    var jqObj = $(obj);
    var container = jqObj;
    var index = container.attr("id").split('imgs')[1];
    console.log(index);
    container.remove();

    delete finalFiles[index];
    //$("#diamond_images").val(finalFiles);
    console.log(finalFiles);

}
function calculateTotalValue(){
    var carat=parseFloat($("input[name='carat']").val());
    var price=parseFloat($("input[name='price']").val().replace(/\,/g,""));
    console.log(carat);
    console.log(price);
    if(isNaN(carat)==false && isNaN(price)==false){
        var totalprice=new Intl.NumberFormat().format(carat*price);
        $("input[name='totalprice']").val(totalprice);    
    }
}