<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profiles;
use App\Diamonds;
use App\RequestDiamond;
use Illuminate\Support\Collection;
class SellerController extends Controller
{
    public function Index(){
        $data['latest_posts']=Diamonds::getActivePost(\Auth::user()->id);
        $data['latest_request']=RequestDiamond::getActiveRequest();
        //dd($data);
        return view('seller.dashboard',$data);
    }
    public function getMyAccount(){
        $user_id=\Auth::user()->id;
        $userdetail=User::getUser($user_id);
        $data['countries']=\DB::table('countries')->select('id','abbreviation')->get()->toArray();
        $data['province']=\DB::table('provinces')->select('id','name')->where('country_id',$userdetail[0]->profiles->country_id)->get()->toArray();
        $data['company_type']=\DB::table('company_type')->select('id','name')->get()->toArray();
        $data['userdetail']=$userdetail[0];
        //dd($data);
        return view('seller.profile',$data);
    }

    public function postMyAccount(Request $request){
        //dd(\Input::all());
        $param=\Input::all();
        $validator=\Validator::make($param, [
                'company_name' => 'required|string|max:255',
                'company_address_1' => 'required|string|max:255',
                'city'=>'required|string|max:255',
                'country_id'=>'required|numeric',
                'province_id'=>'required|numeric',
                'postal_code'=>'required|string|max:6',
                'company_phone' => 'required|numeric',
                'first_name'=>'required|string|max:255',
                'last_name'=>'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$param['user_id'],
            ]);
        //$validator= \Validator::make($param,\Validation::get_rules("seller","editprofile"));

        if($validator->fails()){
            return \Redirect::to('seller/myaccount')
                ->withErrors($validator);
        }

        $user_detail=array(
            'user_id'=>$param['user_id'],
            'first_name'=>$param['first_name'],
            'last_name'=>$param['last_name'],
            'email'=>$param['email']
        );
        $company_detail=array(
            'comp_id'=>$param['comp_id'],
            'company_name'=>$param['company_name'],
            'company_address_1'=>$param['company_address_1'],
            'company_address_2'=>$param['company_address_2'],
            'city'=>$param['city'],
            'country_id'=>$param['country_id'],
            'province_id'=>$param['province_id'],
            'postal_code'=>$param['postal_code'],
            'company_phone'=>$param['company_phone'],
            'type_of_company'=>$param['type_of_company'],
            'other_typeof_company'=>null,
        );
        if($param['type_of_company']==6){
            $company_detail['other_typeof_company']=$param['other_type'];    
        }

        if(isset($param['incorporation_certificate']))
        {
            $company_detail['incorporation_certificate']=$param['incorporation_certificate'];
        }
        if(isset($param['memorandom_certificate']))
        {
            $company_detail['memorandom_certificate']=$param['memorandom_certificate'];
        }
        if(isset($param['acc_rlc_certificate']))
        {
            $company_detail['acc_rlc_certificate']=$param['acc_rlc_certificate'];
        }
        if(isset($param['acc_prov_certificate']))
        {
            $company_detail['acc_prov_certificate']=$param['acc_prov_certificate'];
        }

        $updateData=User::UpdateUser($user_detail);
        $companyUpdate=Profiles::UpdateComapny($company_detail);

        \Session::flash('message', 'Profile Updated Successfully!!');
        \Session::flash('alert-class', 'alert-success');
        return \Redirect::to('seller/myaccount');
    }

    public function Logout(Request $request){
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function getPostDiamond(){
        return view('seller.postdiamond');
    }

    public function getPostDiamondStep1($id=""){


            $data['mines'] = \DB::table('mines')->get()->toArray();
            $data['producer'] = \DB::table('producer')->get()->toArray();
            $data['shapes'] = \DB::table('shapes')->get()->toArray();

            $colors = \DB::table('colors')->where('is_fancy_color', 0)->get()->toArray();
            $data['colorless_color_id'] = array_column($colors, 'id');
            $data['colorless_color_label'] = array_column($colors, 'label');

            $data['fancy_colors'] = \DB::table('colors')->where('is_fancy_color', 1)->get()->toArray();

            $intensity = \DB::table('intensity')->get()->toArray();
            $data['intensity_id'] = array_column($intensity, 'id');
            $data['intensity_name'] = array_column($intensity, 'name');

            $clarity_types = \DB::table('clarity_types')->select('id', 'label')->get()->toArray();
            $data['clarity_types_id'] = array_column($clarity_types, 'id');
            $data['clarity_types_label'] = array_column($clarity_types, 'label');

            $cuttype = \DB::table('cut_types')->select('id', 'label')->get()->toArray();
            $data['cut_types_id'] = array_column($cuttype, 'id');
            $data['cut_types_label'] = array_column($cuttype, 'label');

            $florescence_types = \DB::table('florescence_types')->select('id', 'label')->get()->toArray();
            $data['florescence_types_id'] = array_column($florescence_types, 'id');
            $data['florescence_types_label'] = array_column($florescence_types, 'label');

            $data['brands'] = \DB::table('brands')->get()->toArray();
            $data['certification_laboratories'] = \DB::table('certification_laboratories')->get()->toArray();

        if($id){
            $result=Diamonds::getDiamond($id);
            if(empty($result)){
              return view('errors.404');
            }
            $diamondimg=Diamonds::getDiamondImg($id);
            $data['diamond_detail']=$result[0];
            $data['diamond_img']=$diamondimg;
        }
        //dd($data);
        return view('seller.post_diamond_step_1',$data);
    }

	public function postPostDiamondStep1(Request $request){
        $param=\Input::all();
        //dd($param);
        $imgfilename=array();
        $validator= \Validator::make($param,\Validation::get_rules("seller","post-diamond-step-1"));
        if($validator->fails()){
            return \Redirect::to('seller/pdiamond-step1')
                ->withErrors($validator);
        }
        //dd($param);
        $diamond_data=array(
            'user_id'=>\Auth::user()->id,
            'clarity_type_id'=>$param['clarity'],
            'cut_type_id'=>$param['cut_id'],
            'shape_id'=>$param['shape_id'],
            'florescence_type_id'=>$param['fluorescence'],
            'certification_laboratory_id'=>$param['certification_laboratories_id'],
            'certification_number'=>$param['certificate_number'],
            'origin'=>$param['country_id'].'-'.$param['producer_id'].'-'.$param['mine_id'],
            'brand_id'=>$param['brand_id'],
            'carat'=>$param['carat'],
            'price'=>str_replace(',', '', $param['price']),
            'totalprice'=>str_replace(',', '', $param['totalprice']),
            'status'=>"Uncomplete",
        );

        //dd(\Input::all());
        if($param['colour']=="colourless"){
            $colorArr=array('color_id'=>$param['colourless_slider']);
            $sercolorArr=serialize($colorArr);
            $diamond_data['color_id']=$sercolorArr;
        }else{
            $colorArr=array('color_id_1'=>isset($param['colour_1'])?$param['colour_1']:0,
                            'color_id_2'=>isset($param['colour_2'])?$param['colour_2']:0,
                            'color_id_3'=>isset($param['colour_3'])?$param['colour_3']:0
                            );
            $sercolorArr=serialize($colorArr);
            $diamond_data['color_id']=$sercolorArr;
            $diamond_data['intensity_id']=$param['intensity'];
        }

        if($request->hasFile('diamond_certi_file')){
            $fileNameCer = \Auth::user()->id . time().'dimcer.' .
                $request->file('diamond_certi_file')->getClientOriginalExtension();

            $request->file('diamond_certi_file')->move(
                base_path() . '/public/uploads/diamond_certificate', $fileNameCer
            );
            $diamond_data['diamond_certi_file']=$fileNameCer;
        }
        if(isset($param['diamond_images'])) {
            foreach ($param['diamond_images'] as $key => $file) {
                $filename = \Auth::user()->id . time() . 'dimimg.' . $key . $file->getClientOriginalExtension();
                $file->move(base_path() . '/public/uploads/diamond_img', $filename);
                $imgfilename[$key] = $filename;
            }
        }
        // create temp diamond
        if(isset($param['diamond_id'])) {
            $diamond_data['diamond_id'] = $param['diamond_id'];
            //dd($diamond_data);    
            $create_diamond = Diamonds::update_diamond($diamond_data);
        }else {
            $create_diamond = Diamonds::create_diamond($diamond_data);
        }

        if(!empty($imgfilename)) {
            $uploadimages = Diamonds::StoreImages($imgfilename, $create_diamond);
        }
        return \Redirect::to('seller/pdiamond-step2/'.$create_diamond);

    }

    public function getPostDiamondStep2($id){
        $result=Diamonds::getDiamond($id);
        if(empty($result)){
            return view('errors.404');
        }
        $diamondimg=Diamonds::getDiamondImg($id);
        $data['diamond_img']=$diamondimg;
        $data['diamond_detail']=$result[0];
        //dd($data);
        return view('seller.post_diamond_step_2',$data);
    }

    public function postPostDiamondStep2($id){
        $updateStatus=Diamonds::post_diamond($id);
        \Session::flash('message', 'Post Diamond Successfully!!');
        \Session::flash('alert-class', 'alert-success');
        return \Redirect::to('seller/dashboard');

    }
    public function getRequestFullDetail(){
        $id=\Input::all();
        $record['record']=RequestDiamond::getRequestDiamond(array($id),false);
        return \Response::json($record,200);
    }
    public function getDeleteDiamondImg(){
        $param=\Input::all();
        $deleteImg=Diamonds::deleteDiamondImg($param['id']);
        if($deleteImg){
            echo "Deleted Successfully.!!";
        }
    }

    public function getResetPassword(){
        $data['token']=str_random(20);
        return view('auth.passwords.custom_reset',$data);
    }

    public function getAllPost(){
        $data['mines'] = \DB::table('mines')->get()->toArray();
        $data['producers'] = \DB::table('producer')->get()->toArray();
        $data['shapes'] = \DB::table('shapes')->get()->toArray();
        $data['mypost']=Diamonds::getPosts();
        $data['colorless']=\DB::table('colors')->where('is_fancy_color',0)->get()->toArray();
        $data['fancycolor']=\DB::table('colors')->where('is_fancy_color',1)->get()->toArray();

        $clarity_types = \DB::table('clarity_types')->select('id', 'label')->get()->toArray();
        $data['clarity_types'] = $clarity_types;

        $cuttype = \DB::table('cut_types')->select('id', 'label')->get()->toArray();
        $data['cut_types'] = $cuttype;

        $florescence_types = \DB::table('florescence_types')->select('id', 'label')->get()->toArray();
        $data['florescence_types'] = $florescence_types;
        $data['record_type']="all";
        //dd($data);
        return view('seller.my_post',$data);
    }

    public function getPendingPost(){
        $data['mines'] = \DB::table('mines')->get()->toArray();
        $data['producers'] = \DB::table('producer')->get()->toArray();
        $data['shapes'] = \DB::table('shapes')->get()->toArray();
        $data['colorless']=\DB::table('colors')->where('is_fancy_color',0)->get()->toArray();
        $data['fancycolor']=\DB::table('colors')->where('is_fancy_color',1)->get()->toArray();
        $data['mypost']=Diamonds::getPosts('pending');

        $clarity_types = \DB::table('clarity_types')->select('id', 'label')->get()->toArray();
        $data['clarity_types'] = $clarity_types;

        $cuttype = \DB::table('cut_types')->select('id', 'label')->get()->toArray();
        $data['cut_types'] = $cuttype;

        $florescence_types = \DB::table('florescence_types')->select('id', 'label')->get()->toArray();
        $data['florescence_types'] = $florescence_types;
        $data['record_type']="pending";
        //dd($data);
        return view('seller.my_post',$data);
    }

    public function getPublishedPost(){
        $data['mines'] = \DB::table('mines')->get()->toArray();
        $data['producers'] = \DB::table('producer')->get()->toArray();
        $data['shapes'] = \DB::table('shapes')->get()->toArray();
        $data['colorless']=\DB::table('colors')->where('is_fancy_color',0)->get()->toArray();
        $data['fancycolor']=\DB::table('colors')->where('is_fancy_color',1)->get()->toArray();
        $data['mypost']=Diamonds::getPosts('published');

        $clarity_types = \DB::table('clarity_types')->select('id', 'label')->get()->toArray();
        $data['clarity_types'] = $clarity_types;

        $cuttype = \DB::table('cut_types')->select('id', 'label')->get()->toArray();
        $data['cut_types'] = $cuttype;

        $florescence_types = \DB::table('florescence_types')->select('id', 'label')->get()->toArray();
        $data['florescence_types'] = $florescence_types;
        $data['record_type']="published";
        //dd($data);
        return view('seller.my_post',$data);
    }

    public function getArchivedPost(){
        $data['mines'] = \DB::table('mines')->get()->toArray();
        $data['producers'] = \DB::table('producer')->get()->toArray();
        $data['shapes'] = \DB::table('shapes')->get()->toArray();
        $data['colorless']=\DB::table('colors')->where('is_fancy_color',0)->get()->toArray();
        $data['fancycolor']=\DB::table('colors')->where('is_fancy_color',1)->get()->toArray();
        $data['mypost']=Diamonds::getPosts('archived');

        $clarity_types = \DB::table('clarity_types')->select('id', 'label')->get()->toArray();
        $data['clarity_types'] = $clarity_types;

        $cuttype = \DB::table('cut_types')->select('id', 'label')->get()->toArray();
        $data['cut_types'] = $cuttype;

        $florescence_types = \DB::table('florescence_types')->select('id', 'label')->get()->toArray();
        $data['florescence_types'] = $florescence_types;
        $data['record_type']="archived";
        //dd($data);
        return view('seller.my_post',$data);
    }

    public function postGetAjaxMyPost(){
        $param=\Input::all();

        $getData['data']=Diamonds::getPostByAjaxCall($param);

        $getData['recordcount']=((!isset($getData['data']['recordcount']))?count($getData['data']):0);
        return \Response::json($getData,200);
    }

    public function postCompareDiamond(){
        $param=\Input::all();

        $record['record']=Diamonds::getFullDetail($param['dataArr']);
        return \Response::json($record,200);
    }

    public function getDiamondFullDetail(){
        $id=\Input::all();
        $record['record']=Diamonds::getFullDetail(array($id));
        return \Response::json($record,200);

    }
    public function getUploadCSVStep1(){
        return view('seller.upload_diamond_step_1');
    }

    /*public function getUploadCSVStep2(){
        return view('seller.upload_diamond_step_2');
    }

    public function getUploadCSVStep3(){
        return view('seller.upload_diamond_step_3');
    }*/

    public function postUploadCSVStep1(Request $request){

        $param=\Input::all();
//dd($param);

        /*  $validator= \Validator::make($param,\Validation::get_rules("seller","upload-csv-1"));

          if($validator->fails()){
              return \Redirect::to('seller/upload-csv-1')
                  ->withErrors($validator);
          }*/

        $HeaderArr=array(
            'id','username','gridle_type','culet_type','polish_type','symmetry_type','clarity_type',
            'color','intensity','cut_type','shape','florescence_type','certification_laboratory',
            'certification_number','origin','brand','carat','price','totalprice','depth','status',
            'diamond_certi_file','width','length','depth_percent','table_percent','diamond_image'
        );

        $path = $request->file('upload_csv_seller')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        $result = array_diff($data[0], $HeaderArr);

        if(!empty($result)){
            \Session::flash('message', 'You uploded wrong file.');
            \Session::flash('alert-class', 'alert-danger');
            return \Redirect::to('seller/upload-csv-1');
        }


        if(isset($param['upload_csv_seller'])) {

            $fileNameCSV = \Auth::user()->id . time().'dimcsv.' .
                $request->file('upload_csv_seller')->getClientOriginalExtension();

            $request->file('upload_csv_seller')->move(
                base_path() . '/public/uploads/diamond_csv/', $fileNameCSV
            );
        }

        if (!file_exists(base_path() . '/public/uploads/diamond_csv/'.$fileNameCSV) || !is_readable(base_path() . '/public/uploads/diamond_csv/'.$fileNameCSV))
            return false;

        $header = null;
        $delimiter = ',';
        $data = array();

        if (($handle = fopen(base_path() . '/public/uploads/diamond_csv/'.$fileNameCSV, "r")) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        foreach($data as $data_index=>$data_value){

            $user_id = (array) \DB::table('users')->where('username', $data_value['username'])->select('id')->first();
            $clarity_types_id = (array) \DB::table('clarity_types')->where('label', $data_value['clarity_type'])->select('id')->first();
            $cut_type_id = (array) \DB::table('cut_types')->where('label', $data_value['cut_type'])->select('id')->first();
            $shape_id = (array) \DB::table('shapes')->where('label', $data_value['shape'])->select('id')->first();
            $florescence_type_id = (array) \DB::table('florescence_types')->where('label', $data_value['florescence_type'])->select('id')->first();
            $certification_laboratory_id = (array) \DB::table('certification_laboratories')->where('label', $data_value['certification_laboratory'])->select('id')->first();
            $brand_id = (array) \DB::table('brands')->where('label', $data_value['brand'])->select('id')->first();

            //$origin_array = explode('-',$data['origin']);

            $diamond_data=array(
                'user_id'=>$user_id['id'],
                'clarity_type_id'=>$clarity_types_id['id'],
                'cut_type_id'=>$cut_type_id['id'],
                'shape_id'=>$shape_id['id'],
                'florescence_type_id'=>$florescence_type_id['id'],
                'certification_laboratory_id'=>$certification_laboratory_id['id'],
                'certification_number'=>$data_value['certification_number'],
                'origin'=>$data_value['origin'],
                'brand_id'=>$brand_id['id'],
                'carat'=>$data_value['carat'],
                'price'=>$data_value['price'],
                'totalprice'=>$data_value['totalprice'],
                'status'=>$data_value['status'],
                'diamond_certi_file'=>$data_value['diamond_certi_file'],
            );
            if(isset($data_value['diamond_certi_file']) && ($data_value['diamond_certi_file']=="" || $data_value['diamond_certi_file']==null)){
                $diamond_data['status']="Pending";
            }

            if(isset($data_value['diamond_image']) && ($data_value['diamond_image']=="" || $data_value['diamond_image']==null)){
                $diamond_data['status']="Pending";
            }


            if($data_value['intensity'] == 'null'){
                $color_id = (array) \DB::table('colors')->where('label', $data_value['color'])->select('id')->first();
                $colorArr=array('color_id'=>$color_id['id']);
                $sercolorArr= serialize($colorArr);
                $diamond_data['color_id']=$sercolorArr;
            }else{
                $color_array = explode(',',$data_value['color']);
                $color_id1 = (array) \DB::table('colors')->where('label', $color_array[0])->select('id')->first();
                $color_id2 = (array) \DB::table('colors')->where('label', $color_array[1])->select('id')->first();
                $color_id3 = (array) \DB::table('colors')->where('label', $color_array[2])->select('id')->first();

                $colorArr=array('color_id_1'=>isset($color_array[0])?$color_id1['id']:0,
                    'color_id_2'=>isset($color_array[1])?$color_id2['id']:0,
                    'color_id_3'=>isset($color_array[2]) && $color_array[2]  != 'None' ? $color_id3['id']:0
                );
                $sercolorArr=$colorArr;
                $diamond_data['color_id']=serialize($sercolorArr);

                $intensity_id = (array) \DB::table('intensity')->where('name', $data_value['intensity'])->select('id')->first();

                $diamond_data['intensity_id']=$intensity_id['id'];
            }

            $create_diamond = Diamonds::create_diamond($diamond_data);

            $diamond_image_array = explode(',',$data_value['diamond_image']);

            if(isset($data_value['diamond_image']) && $data_value['diamond_image']!="") {
                foreach ($diamond_image_array as $key => $file) {
                    //echo "<br>".$file;
                    $file_extension = explode('.',$file);
                    $name = $string = preg_replace('/\s+/', '', $file_extension[0]);
                    $filename = \Auth::user()->id .$name. 'dimimg' . ".". $file_extension[1];
                    //$file->move(base_path() . '/public/uploads/diamond_img', $filename);
                    $imgfilename[$key] = $filename;

                }
            }

            if(!empty($imgfilename)) {
                $uploadimages = Diamonds::StoreImages($imgfilename, $create_diamond);

            }
        }

        if(isset($param['upload_dmgimg_seller'])) {

            foreach ($param['upload_dmgimg_seller'] as $key => $file) {
                $filename = \Auth::user()->id.preg_replace('/\s+/', '', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'dimimg' . ".". $file->getClientOriginalExtension();

                $file->move(base_path() . '/public/uploads/diamond_img/', $filename);
                $imgfilename[$key] = $filename;
            }
        }

        if(isset($param['upload_dmgpdf_seller'])) {
            foreach ($param['upload_dmgpdf_seller'] as $key => $file) {
                $filename = $file->getClientOriginalName();
                $file->move(base_path() . '/public/uploads/diamond_certificate/', $filename);
                $imgfilename[$key] = $filename;
            }
        }
        \Session::flash('message', 'Your diamonds uploaded Successfully.');
        \Session::flash('alert-class', 'alert-success');
        return \Redirect::to('seller/dashboard');


        //return \Redirect::to('seller/upload-csv-2');

    }
    
    public function postUploadDmgImgStep2(Request $request){
		
		$param=\Input::all();

		/*$validator= \Validator::make($param,\Validation::get_rules("seller","upload-csv-2"));
        if($validator->fails()){
            return \Redirect::to('seller/upload-csv-2')
                ->withErrors($validator);
        }*/
		if(isset($param['upload_dmgimg_seller'])) {
            foreach ($param['upload_dmgimg_seller'] as $key => $file) {
                $filename = \Auth::user()->id .'dimimg' . $key . ".". $file->getClientOriginalExtension();
                $file->move(base_path() . '/public/uploads/diamond_img/', $filename);
                $imgfilename[$key] = $filename;
            }
        }
        
        //return \Redirect::to('seller/upload-csv-3');
	}
	
    public function postUploadDmgPdfStep3(Request $request){
		
		$param=\Input::all();

		/*$validator= \Validator::make($param,\Validation::get_rules("seller","upload-csv-3"));
        if($validator->fails()){
            return \Redirect::to('seller/upload-csv-3')
                ->withErrors($validator);
        }*/
		if(isset($param['upload_dmgpdf_seller'])) {
            foreach ($param['upload_dmgpdf_seller'] as $key => $file) {
                $filename = \Auth::user()->id .'dimcer' . $key . ".". $file->getClientOriginalExtension();
                $file->move(base_path() . '/public/uploads/diamond_certificate/', $filename);
                $imgfilename[$key] = $filename;
            }
        }
        \Session::flash('message', 'Your diamonds uploaded Successfully.');
        \Session::flash('alert-class', 'alert-success');
        return \Redirect::to('seller/dashboard');
	}
	
	

    //search request

    function getSearchRequest(){
        $data['mines'] = \DB::table('mines')->get()->toArray();
        $data['producers'] = \DB::table('producer')->get()->toArray();
        $data['shapes'] = \DB::table('shapes')->get()->toArray();
        $data['colorless']=\DB::table('colors')->where('is_fancy_color',0)->get()->toArray();
        $data['fancycolor']=\DB::table('colors')->where('is_fancy_color',1)->get()->toArray();

        $clarity_types = \DB::table('clarity_types')->select('id', 'label')->get()->toArray();
        $data['clarity_types'] = $clarity_types;

        $cuttype = \DB::table('cut_types')->select('id', 'label')->get()->toArray();
        $data['cut_types'] = $cuttype;

        $florescence_types = \DB::table('florescence_types')->select('id', 'label')->get()->toArray();
        $data['florescence_types'] = $florescence_types;
        $data['record_type']="archived";

        return view('seller.search_request',$data);
    }

    function postGetAjaxMyRequest(){
        $param=\Input::all();
        $getData['data']=RequestDiamond::getRequestByAjaxCall($param);

        return \Response::json($getData,200);
    }

    public function postArchiveDiamond()
    {
        $param=\Input::all();
        $archiveRecord=Diamonds::ArchiveDiamond($param['dataArr']);
        return \Response::json($archiveRecord,200);
    }

    public function postDeleteDiamond()
    {
        $param=\Input::all();
        $archiveRecord=Diamonds::DeleteRecord($param['dataArr']);
        return \Response::json($archiveRecord,200);   
    }

    public function getEditPost($id)
    {
        $data['mines'] = \DB::table('mines')->get()->toArray();
        $data['producer'] = \DB::table('producer')->get()->toArray();
        $data['shapes'] = \DB::table('shapes')->get()->toArray();

        $colors = \DB::table('colors')->where('is_fancy_color', 0)->get()->toArray();
            $data['colorless_color_id'] = array_column($colors, 'id');
            $data['colorless_color_label'] = array_column($colors, 'label');

            $data['fancy_colors'] = \DB::table('colors')->where('is_fancy_color', 1)->get()->toArray();

            $intensity = \DB::table('intensity')->get()->toArray();
            $data['intensity_id'] = array_column($intensity, 'id');
            $data['intensity_name'] = array_column($intensity, 'name');

            $clarity_types = \DB::table('clarity_types')->select('id', 'label')->get()->toArray();
            $data['clarity_types_id'] = array_column($clarity_types, 'id');
            $data['clarity_types_label'] = array_column($clarity_types, 'label');

            $cuttype = \DB::table('cut_types')->select('id', 'label')->get()->toArray();
            $data['cut_types_id'] = array_column($cuttype, 'id');
            $data['cut_types_label'] = array_column($cuttype, 'label');

            $florescence_types = \DB::table('florescence_types')->select('id', 'label')->get()->toArray();
            $data['florescence_types_id'] = array_column($florescence_types, 'id');
            $data['florescence_types_label'] = array_column($florescence_types, 'label');

            $data['brands'] = \DB::table('brands')->get()->toArray();
            $data['certification_laboratories'] = \DB::table('certification_laboratories')->get()->toArray();

            $diamondimg=Diamonds::getDiamondImg($id);
            $data['diamond_img']=$diamondimg;

        $diamond=Diamonds::getDiamond($id);
        $data['diamond_detail']=$diamond[0];

        return view('seller.editpost',$data);
    }

    public function postUpdateDiamond(Request $request){
        $param=\Input::all();
        //dd($param);
        $imgfilename=array();
        $validator= \Validator::make($param,\Validation::get_rules("seller","post-diamond-step-1"));
        if($validator->fails()){
            return \Redirect::to('seller/editpost/'.$param['diamond_id'])
                ->withErrors($validator);
        }
        //dd($param);
        $diamond_data=array(
            'user_id'=>\Auth::user()->id,
            'clarity_type_id'=>$param['clarity'],
            'cut_type_id'=>$param['cut_id'],
            'shape_id'=>$param['shape_id'],
            'florescence_type_id'=>$param['fluorescence'],
            'certification_laboratory_id'=>$param['certification_laboratories_id'],
            'certification_number'=>$param['certificate_number'],
            'origin'=>$param['country_id'].'-'.$param['producer_id'].'-'.$param['mine_id'],
            'brand_id'=>$param['brand_id'],
            'carat'=>$param['carat'],
            'price'=>str_replace(',', '', $param['price']),
            'totalprice'=>str_replace(',', '', $param['totalprice']),
        );
        
        //dd(\Input::all());
        if($param['colour']=="colourless"){
            $colorArr=array('color_id'=>$param['colourless_slider']);
            $sercolorArr=serialize($colorArr);
            $diamond_data['color_id']=$sercolorArr;
            $diamond_data['intensity_id']=null;
        }else{
            $colorArr=array('color_id_1'=>isset($param['colour_1'])?$param['colour_1']:0,
                            'color_id_2'=>isset($param['colour_2'])?$param['colour_2']:0,
                            'color_id_3'=>isset($param['colour_3'])?$param['colour_3']:0
                            );
            $sercolorArr=serialize($colorArr);
            $diamond_data['color_id']=$sercolorArr;
            $diamond_data['intensity_id']=$param['intensity'];
        }

        if($request->hasFile('diamond_certi_file')){
            $fileNameCer = \Auth::user()->id . time().'dimcer.' .
                $request->file('diamond_certi_file')->getClientOriginalExtension();

            $request->file('diamond_certi_file')->move(
                base_path() . '/public/uploads/diamond_certificate', $fileNameCer
            );
            $diamond_data['diamond_certi_file']=$fileNameCer;
        }
        if(isset($param['diamond_images'])) {
            foreach ($param['diamond_images'] as $key => $file) {
                $filename = \Auth::user()->id . time() . 'dimimg.' . $key . $file->getClientOriginalExtension();
                $file->move(base_path() . '/public/uploads/diamond_img', $filename);
                $imgfilename[$key] = $filename;
            }
        }
        // create temp diamond
        if(isset($param['diamond_id'])) {
            $diamond_data['diamond_id'] = $param['diamond_id'];
            //dd($diamond_data);    
            $create_diamond = Diamonds::update_diamond($diamond_data);
        }

        if(!empty($imgfilename)) {
            $uploadimages = Diamonds::StoreImages($imgfilename, $create_diamond);
        }
        \Session::flash('message', 'Diamond Edited Successfully!!');
        \Session::flash('alert-class', 'alert-success');
        return \Redirect::to('seller/all-post');
    }

     public function getDownloadASPdf($id){
        $diamond['diamond']=Diamonds::getFullDetail(array($id));
        //dd($diamond);

        $filename="Diamond-detail".date('Y-m-d')."_".time().".pdf";
        $html = view('templates.diamond-pdf',$diamond)->render();
        //echo $html;die;
        return \PDF::load($html)->filename($filename)->download();


    }  

    public function postBecomeBuyer(){
        $userid=\Auth::user()->id;
        $updateRole=\App\User::updateRole($userid);
        \Session::flash('message', 'You Are Become As Buyer Successfully!!');
        \Session::flash('alert-class', 'alert-success');
        return \Redirect::to('seller/dashboard');
    }
}
