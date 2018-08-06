<?php

namespace App\Http\Controllers;

use App\Profiles;
use Illuminate\Http\Request;
use App\User;
use App\Diamonds;
use App\RequestDiamond;
use App\Lib\Validation;
use Illuminate\Support\Facades\Validator;
class BuyerController extends Controller
{
    public function Index(){
        $data['latest_posts']=Diamonds::getActivePost();
        $data['latest_request']=RequestDiamond::getActiveRequest(\Auth::user()->id);
        return view('buyer.dashboard',$data);
    }
    public function getMyAccount(){
        $user_id=\Auth::user()->id;
        $userdetail=User::getUser($user_id);
        $data['countries']=\DB::table('countries')->select('id','abbreviation')->get()->toArray();
        $data['province']=\DB::table('provinces')->select('id','name')->where('country_id',$userdetail[0]->profiles->country_id)->get()->toArray();
        $data['company_type']=\DB::table('company_type')->select('id','name')->get()->toArray();
        $data['userdetail']=$userdetail[0];
        //dd($data);
        return view('buyer.profile',$data);
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
        //$validator= \Validator::make($param,\Validation::get_rules("buyer","editprofile"));

        if($validator->fails()){
            return \Redirect::to('buyer/myaccount')
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

            $updateData=User::UpdateUser($user_detail);
            $companyUpdate=Profiles::UpdateComapny($company_detail);

            \Session::flash('message', 'Profile Updated Successfully!!');
            \Session::flash('alert-class', 'alert-success');
            return \Redirect::to('buyer/myaccount');
    }

    public function getRequestDiamond(){
        return view('buyer.request_diamond');
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
            $result=RequestDiamond::getRequestDiamond($id,true);

            if(empty($result)){
                return view('errors.404');
            }
            $data['diamond_detail']=$result[0];

        }
        //dd($data);
        return view('buyer.post_diamond_step_1',$data);
    }

    public function postPostDiamondStep1(Request $request){
        //dd(\Input::all());
        $param=\Input::all();
        $validator= \Validator::make($param,\Validation::get_rules("buyer","post-diamond-step-1"));
        if($validator->fails()){
            return \Redirect::to('buyer/pdiamond-step1')
                ->withErrors($validator);
        }

        $diamond_data=array(
            'user_id'=>\Auth::user()->id,
            'clarity_type_id'=>$param['clarity'],
            'cut_type_id'=>$param['cut_id'],
            'shape_id'=>$param['shape_id'],
            'florescence_type_id'=>$param['fluorescence'],
            'certification_laboratory_id'=>implode(',',$param['certification_laboratories_id']),
            'brand_id'=>implode(',',$param['brand_id']),
            'carat_min'=>$param['carat_min'],
            'carat_max'=>$param['carat_max'],
            'comments'=>$param['comments'],
            'status'=>"Uncomplete",
        );

        if(isset($param['country_id']) && isset($param['mine_id']) && isset($param['producer_id'])){

            $ct_count=count($param['country_id']);
            $pr_count=count($param['producer_id']);
            $mn_count=count($param['mine_id']);
            $a = array($ct_count, $pr_count, $mn_count);
            
            if(!(count(array_unique($a)) == 1)){
                
            }

            foreach ($param['country_id'] as $key => $cid){
                $diamond_data['origin'][$key]=$cid.'-'.(isset($param['producer_id'][$key])?$param['producer_id'][$key]:'').'-'.(isset($param['mine_id'][$key])?$param['mine_id'][$key]:'');
            }
        }
        $diamond_data['origin']=implode(',',$diamond_data['origin']);
        //dd($diamond_data);
        if($param['colour']=="colourless"){
            $colorArr=array('color_id'=>$param['colourless_slider']);
            $sercolorArr=serialize($colorArr);
            $diamond_data['color_id']=$sercolorArr;
            $diamond_data['intensity_id']=null;
        }else{
            $colorArr=array('color_id_1'=>$param['colour_1'],
                'color_id_2'=>$param['colour_2'],
                'color_id_3'=>$param['colour_3']
            );
            $sercolorArr=serialize($colorArr);
            $diamond_data['color_id']=$sercolorArr;
            $diamond_data['intensity_id']=$param['intensity'];
        }

        if(isset($param['diamond_id'])) {
            $diamond_data['diamond_id'] = $param['diamond_id'];

            $create_diamond = RequestDiamond::update_diamond($diamond_data);
        }else {
            $create_diamond = RequestDiamond::create_diamond($diamond_data);
        }

        return \Redirect::to('buyer/pdiamond-step2/'.$create_diamond);
    }

    public function getPostDiamondStep2($id){
        $result=RequestDiamond::getRequestDiamond($id,true);
        //dd($result);
        if(empty($result)){
            return view('errors.404');
        }
        /*$diamondimg=Diamonds::getDiamondImg($id);
        $data['diamond_img']=$diamondimg;*/
        $data['diamond_detail']=$result[0];

        return view('buyer.post_diamond_step_2',$data);
    }

    public function postPostDiamondStep2($id){
        $updateStatus=RequestDiamond::post_diamond($id);
        \Session::flash('message', 'Diamond Request Posted Successfully!!');
        \Session::flash('alert-class', 'alert-success');
        return \Redirect::to('buyer/dashboard');
    }

    public function getResetPassword(){
        $data['token']=str_random(20);
        return view('auth.passwords.custom_reset',$data);
    }

    //my request

    public function getAllRequest(){
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
        $data['record_type']="all";

        return view('buyer.my_request',$data);
    }

    public function getArchivedRequest(){
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

        return view('buyer.my_request',$data);
    }



    public function postGetAjaxMyRequest(){
        $param=\Input::all();

        $getData['data']=RequestDiamond::getUserRequestByAjaxCall($param);
        
        $getData['recordcount']=((!isset($getData['data']['recordcount']))?count($getData['data']):0);
        return \Response::json($getData,200);
    }

    public function getRequestFullDetail(){
        $id=\Input::all();
        $record['record']=RequestDiamond::getRequestDiamond(array($id),true);
        return \Response::json($record,200);
    }

    public function getSearchDiamond(){
        $data['mines'] = \DB::table('mines')->get()->toArray();
        $data['producers'] = \DB::table('producer')->get()->toArray();
        $data['shapes'] = \DB::table('shapes')->get()->toArray();
        $data['ActiveRecCount']=Diamonds::Active()->count();
        $data['colorless']=\DB::table('colors')->where('is_fancy_color',0)->get()->toArray();
        $data['fancycolor']=\DB::table('colors')->where('is_fancy_color',1)->get()->toArray();            
        
        $clarity_types = \DB::table('clarity_types')->select('id', 'label')->get()->toArray();
        $data['clarity_types'] = $clarity_types;

        $cuttype = \DB::table('cut_types')->select('id', 'label')->get()->toArray();
        $data['cut_types'] = $cuttype;

        $florescence_types = \DB::table('florescence_types')->select('id', 'label')->get()->toArray();
        $data['florescence_types'] = $florescence_types;
        $data['record_type']="all";
        return view('buyer.search_diamond',$data);
    }

    public function postAjaxSearchDiamond(){
        $param=\Input::all();
        $getData['data']=Diamonds::getAjaxSearchDiamond($param);

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
    public function postArchiveRequest()
    {
        $param=\Input::all();
        $archiveRecord=RequestDiamond::ArchiveRecord($param['dataArr']);
        return \Response::json($archiveRecord,200);
    }

    public function postDeleteRequest()
    {
        $param=\Input::all();
        $archiveRecord=RequestDiamond::DeleteRecord($param['dataArr']);
        return \Response::json($archiveRecord,200);   
    }

    public function getEditRequest($id){
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

        $result=RequestDiamond::getRequestDiamond($id,true);

            if(empty($result)){
                return view('errors.404');
            }
            $data['diamond_detail']=$result[0];

        return view('buyer.edit_request',$data);
    }

    public function postUpdateRequest(){
        $param=\Input::all();
        
        
        $validator= \Validator::make($param,\Validation::get_rules("buyer","post-diamond-step-1"));
        if($validator->fails()){
            return \Redirect::to('buyer/edit-request/'.$param['diamond_id'])
                ->withErrors($validator);
        }

        $diamond_data=array(
            'user_id'=>\Auth::user()->id,
            'clarity_type_id'=>$param['clarity'],
            'cut_type_id'=>$param['cut_id'],
            'shape_id'=>$param['shape_id'],
            'florescence_type_id'=>$param['fluorescence'],
            'certification_laboratory_id'=>implode(',',$param['certification_laboratories_id']),
            'brand_id'=>implode(',',$param['brand_id']),
            'carat_min'=>$param['carat_min'],
            'carat_max'=>$param['carat_max'],
            'comments'=>$param['comments'],
        );

        if(isset($param['country_id']) && isset($param['mine_id']) && isset($param['producer_id'])){

            $ct_count=count($param['country_id']);
            $pr_count=count($param['producer_id']);
            $mn_count=count($param['mine_id']);
            $a = array($ct_count, $pr_count, $mn_count);
            
            if(!(count(array_unique($a)) == 1)){
                
            }

            foreach ($param['country_id'] as $key => $cid){
                $diamond_data['origin'][$key]=$cid.'-'.(isset($param['producer_id'][$key])?$param['producer_id'][$key]:'').'-'.(isset($param['mine_id'][$key])?$param['mine_id'][$key]:'');
            }
        }
        $diamond_data['origin']=implode(',',$diamond_data['origin']);

        if($param['colour']=="colourless"){
            $colorArr=array('color_id'=>$param['colourless_slider']);
            $sercolorArr=serialize($colorArr);
            $diamond_data['color_id']=$sercolorArr;
            $diamond_data['intensity_id']=null;
        }else{
            $colorArr=array('color_id_1'=>$param['colour_1'],
                'color_id_2'=>$param['colour_2'],
                'color_id_3'=>$param['colour_3']
            );
            $sercolorArr=serialize($colorArr);
            $diamond_data['color_id']=$sercolorArr;
            $diamond_data['intensity_id']=$param['intensity'];
        }

        $diamond_data['diamond_id'] = $param['diamond_id'];
        $create_diamond = RequestDiamond::update_diamond($diamond_data);

        \Session::flash('message', 'Request Edited Successfully!!');
        \Session::flash('alert-class', 'alert-success');
        return \Redirect::to('buyer/all-request');
    }
      
    public function getDownloadASPdf($id){
        $diamond['diamond']=Diamonds::getFullDetail(array($id));
        //dd($diamond);

        $filename="Diamond-detail".date('Y-m-d')."_".time().".pdf";
        $html = view('templates.diamond-pdf',$diamond)->render();
        //echo $html;die;
        return \PDF::load($html)->filename($filename)->download();


    }  

    public function postBecomeSeller(){
        $userid=\Auth::user()->id;
        $updateRole=\App\User::updateRole($userid);
        \Session::flash('message', 'You Are Become As Seller Successfully!!');
        \Session::flash('alert-class', 'alert-success');
        return \Redirect::to('buyer/dashboard');
    }

}
