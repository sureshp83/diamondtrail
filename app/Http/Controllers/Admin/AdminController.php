<?php

namespace App\Http\Controllers\Admin;

use App\lib\Validation;
use App\Admin;
use App\User;
use App\Profiles;
use App\Diamonds;
use App\General;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
     public function __construct(){
        $data['uncompleteuser']=User::where('status','Uncomplete')->get()->toArray();
        \View::share($data);
     }

    public function getDashboard(){
        $data['users']=User::Active()->count();
        $data['diamonds']=Diamonds::Active()->count();
        $data['requests']=\App\RequestDiamond::Active()->count();
        return view('vendor.adminlte.home',$data);
    }

    public function getAdminLogin(){
        
        return view('vendor.adminlte.auth.login');
    }

    public function postLogin(Request $request){

        $validator=\Validator::make($request->all(),Validation::get_rules("admin","login"));

        if($validator->fails()){
            return \Redirect::to('admin/login')->WithErrors($validator);
        }

        $doLogin=Admin::doLogin($request->all());

        if($doLogin){
            \Session::flash('message','Login Successfully!!');
            \Session::flash('alert-class', 'alert-success');
            return \Redirect::to('admin/dashboard');
        }else{
            return \Redirect::to('admin/login')->WithErrors(array('message'=>'You entered wrong credentials,please try with correct credentials.'));
        }

    }

    public function getLogout(){
        \Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function getVendors(){
        //$data['seller_user']=User::getSellerUser();
        return view('vendor.adminlte.vendors.vendors');
    }

    public function getAjaxVendorsList(){
        $data['data']=User::getVendorsUser();

        return \Response::json($data,200);
    }

    public function getSellerUsers(){
        
        return view('vendor.adminlte.users.sellers');
    }

    public function getAjaxSellersList(){
        $data['data']=User::getSellersUser();
        return \Response::json($data,200);
    }

    public function getBuyersUsers(){
        
        return view('vendor.adminlte.users.buyers');
    }

    public function getAjaxBuyersList(){
        $data['data']=User::getBuyersUser();
        return \Response::json($data,200);
    }

    public function getEditUser($id){
        $role=User::find($id)->roles[0]->name;
        if($role=="Buyer"){
            $data['back_url']="buyer-users"; 
        }else if($role=="Seller"){
           $data['back_url']="seller-users"; 
        }else{
           $data['back_url']="seller-users"; 
        }
        $data['userdetail']=User::getUser($id);

        $data['company_type']=\DB::table('company_type')->get()->toArray();
        $data['countries']=\DB::table('countries')->get()->toArray();
        $data['province']=\DB::table('provinces')->get()->toArray();

        return view('vendor.adminlte.users.edituser',$data);
    }

    public function postEditUser(Request $request){
        $param=\Input::all();
        $userdetail=array(
            'user_id'=>$param['user_id'],
            'first_name'=>$param['first_name'],
            'last_name'=>$param['last_name'],
            'status'=>$param['status']
        );

        $compdetail=array(
            'comp_id'=>$param['comp_id'],
            'company_name'=>$param['company_name'],
            'company_address_1'=>$param['company_address_1'],
            'company_address_2'=>$param['company_address_2'],
            'country_id'=>$param['country_id'],
            'province_id'=>$param['province_id'],
            'city'=>$param['city'],
            'postal_code'=>$param['postal_code'],
            'company_phone'=>$param['company_phone'],
            'company_web'=>$param['company_web'],
            'type_of_company'=>$param['type_of_company'],
            'other_typeof_company'=>$param['other_type']    
            );
        if($param['type_of_company'] == 6){
            $compdetail['other_typeof_company']=$param['other_type'];
        }
        if($request->hasFile('incorporation_certificate')){
            $incfile=time()."inc.".$request->file('incorporation_certificate')->getClientOriginalExtension();
            $request->file('incorporation_certificate')->move(base_path().'/public/uploads/pdf',$incfile);
            $compdetail['incorporation_certificate']=$incfile;
        }
        if($request->hasFile('memorandom_certificate')){
            $memfile=time()."mem.".$request->file('memorandom_certificate')->getClientOriginalExtension();
            $request->file('memorandom_certificate')->move(base_path().'/public/uploads/pdf',$memfile);
            $compdetail['memorandom_certificate']=$memfile;
        }
        if($request->hasFile('acc_rlc_certificate')){
            $accfile=time()."acc.".$request->file('acc_rlc_certificate')->getClientOriginalExtension();
            $request->file('acc_rlc_certificate')->move(base_path().'/public/uploads/pdf',$accfile);
            $compdetail['acc_rlc_certificate']=$accfile;
        }
        if($request->hasFile('acc_prov_certificate')){
            $provfile=time()."acc.".$request->file('acc_prov_certificate')->getClientOriginalExtension();
            $request->file('acc_prov_certificate')->move(base_path().'/public/uploads/pdf',$provfile);
            $compdetail['acc_prov_certificate']=$provfile;
        }
        $updateUser=User::UpdateUser($userdetail);
        $updateComp=Profiles::UpdateComapny($compdetail);

        \Session::flash('message','User Updated Successfully!!');
        \Session::flash('alert-class','alert-success');
        return Redirect('admin/'.$param['back_url']);
    }

    public function postResetPassword(){
        $param=\Input::all();
        $validator=\Validator::make($param,\Validation::get_rules("admin","reset_password"));

        if($validator->fails()){
            return \Response::json("Password and confirm password does not match.",200);
        }
        $updatepass=User::where('id',$param['p_user_id'])->update(array('password'=>bcrypt($param['cnf_password'])));

        //send reset password mail to user
        
            \Mail::send('emails.admin_reset_password', $param, function($message) use ($param)
            {
                $message->subject("Admin Reset Your Password.");
                $message->to($param['email']);
            });
        return $updatepass;    

    }

    public function getDiamonds($id){
        return view('vendor.adminlte.vendors.diamonds');
    }

    public function getAjaxDiamondsList($id){
        $param['user_id']=$id;
        $param['record_type']="adminside";
        $data['data']=Diamonds::getPostByAjaxCall($param);
        return \Response::json($data,200);
    }

    public function getEditDiamond($id){
        $diamond_detail=Diamonds::getDiamond($id,true);
        $data['diamond_detail']=$diamond_detail[0];
        $data['producer']=\DB::table('producer')->get()->toArray();
        $data['mines']=\DB::table('mines')->get()->toArray();
        $data['shapes']=\DB::table('shapes')->get()->toArray();

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

        return view('vendor.adminlte.vendors.editdiamond',$data);
    }

    public function postEditDiamond(Request $request){
        $param=$request->all();

        $validator=\Validator::make($request->all(),\Validation::get_rules("admin","editdiamond"));
        if($validator->fails()){
            return \Redirect::to('admin/edit-diamond/'.$param['diamond_id'])
                ->withErrors($validator);
        }

        $diamond_data=array(
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
            'status'=>$param['status']
        );

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
        return \Redirect::to('admin/view-diamonds/'.$param['user_id']);
    }

    public function getDeleteDiamondImg(){
        $param=\Input::all();
        $deleteImg=Diamonds::deleteDiamondImg($param['id']);
        if($deleteImg){
            echo "Deleted Successfully.!!";
        }
    }

    public function getDeleteProducerImg(){
        $param=\Input::all();
        $deleteImg=General::deleteProducerImg($param['id']);
        if($deleteImg){
            echo "Deleted Successfully.!!";
        }   
    }

    public function getDeleteProducerPdf(){
        $param=\Input::all();
        $deleteImg=General::deleteProducerPdf($param['id']);
        if($deleteImg){
            echo "Deleted Successfully.!!";
        }   
    }

    public function postDeleteDiamond(){
        $param=\Input::all();

        $deleteRecord=Diamonds::DeleteRecord(array($param['dim_id']));
        \Session::flash('message', 'Diamond Deleted Successfully!!');
        \Session::flash('alert-class', 'alert-success');
        return \Redirect::to('admin/view-diamonds/'.$param['user_id']);
    }

    public function getAdminProfile(){
        $data['admin']=Admin::get()->toArray();
        return view('vendor.adminlte.profile',$data);
    }

    public function postAdminProfile(Request $request){
    	
    	$param=$request->all();
    	
    	$admin=array(
        	'username'=>$param['username'],
        	'first_name'=>$param['first_name'],
        	'last_name'=>$param['last_name'],
        	'email'=>$param['email'],
        	'password'=>bcrypt($param['password']),
        	'password_string'=>$param['password']
        	);

    	if($request->hasFile('profile_pic')){
    		$profilename=time().'profileimg.'.$request->file('profile_pic')->getClientOriginalExtension();
    		$request->file('profile_pic')->move(base_path().'/public/images',$profilename);
    		$admin['profile_pic']=$profilename;
    	}

    	$updateprofile=Admin::updateprofile($admin);
    	\Session::flash('message','Profile Updated Successfully.!!');
    	\Session::flash('alert-class','alert-success');
    	return redirect('admin\dashboard');
        
    }

    public function getPublicHomeContent(){
        $content=General::getPagesContentByType('public_home');
        $data['content']=isset($content[0])?$content[0]:$content;
        return view('vendor.adminlte.pages.public_home',$data);
    }

    public function postPublicHomeContent(Request $request){
        $param=$request->all();

        $contentArr=array(
                'page_type'=>'public_home',
                'block_no'=>1,
                'block_title'=>$param['block_title'],
                'block_content'=>$param['editor1'],
            );

        if($request->hasFile('block_image')){
            $filename=time().'publichome.'.$request->file('block_image')->getClientOriginalExtension();
            $request->file('block_image')->move(base_path().'/public/images/pages_img',$filename);
            $contentArr['block_img']=$filename;
        }
        
        if(isset($param['content_id']) && $param['content_id']!=""){
            $contentArr['content_id']=$param['content_id'];
            $insertText=General::UpdatePagesContent($contentArr);
        }
        else{
            $contentArr['created_at']=date('Y-m-d H:i:s');
            $insertText=General::InsertPagesContent($contentArr);
        }
            
        \Session::flash('alert-class','alert-success');
        \Session::flash('message','Public Home Page Content Updated Successfully.!!');
        return redirect('admin/dashboard');

    }

    public function getPublicTradingContent(){
        $content=General::getPagesContentByType('trading_home');
        $data['content']=isset($content[0])?$content[0]:$content;
        return view('vendor.adminlte.pages.trading_home',$data);        
    }

    public function getAboutUsContent(){
        
        $data['content']=General::getPagesContentByType('about-us');
        return view('vendor.adminlte.pages.about-us',$data);        
    }

    public function UploadContentImage(Request $request){

        if($request->hasFile('file')){
            $filename=time().'publichome.'.$request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(base_path().'/public/images/pages_img',$filename);
            return \Response::json(["location"=>"/images/pages_img/".$filename]);
        }
    } 

    public function postAboutUsContent(Request $request){
       // dd($request->all());
        
        $param=$request->all();

        $contentArr=array(
                'page_type'=>'about-us',
                'block_content'=>$param['editor1'],
            );
        if($request->hasFile('image')){
            $contentArr['block_img']=$param['imagename'];    
        }       
        if(isset($param['content_id']) && $param['content_id']!=""){
            $contentArr['content_id']=$param['content_id'];
            $insertText=General::UpdatePagesContent($contentArr);
        }
        else{
            $contentArr['created_at']=date('Y-m-d H:i:s');
            $insertText=General::InsertPagesContent($contentArr);
        }        

        \Session::flash('alert-class','alert-success');
        \Session::flash('message','About Us Content Updated Successfully.!!');
        return redirect('admin/dashboard');
    }
    
    public function getTraceability(){
        $data['content']=General::getPagesContentByType('traceability');
        return view('vendor.adminlte.pages.traceability',$data);                
    }

    public function postTraceability(Request $request){
        $param=$request->all();

        $contentArr=array(
                'page_type'=>'traceability',
                'block_content'=>$param['editor1'],
            );
        if($request->hasFile('image')){
            $contentArr['block_img']=$param['imagename'];    
        }       
        if(isset($param['content_id']) && $param['content_id']!=""){
            $contentArr['content_id']=$param['content_id'];
            $insertText=General::UpdatePagesContent($contentArr);
        }
        else{
            $contentArr['created_at']=date('Y-m-d H:i:s');
            $insertText=General::InsertPagesContent($contentArr);
        }        

        \Session::flash('alert-class','alert-success');
        \Session::flash('message','Traceability Program Page Content Updated Successfully.!!');
        return redirect('admin/dashboard');
    }    

    public function getProducer(){
        $data['content']=General::getAllProducersContent();
        //dd($data);
        return view('vendor.adminlte.pages.producer',$data);                        
    }

    public function postProducer(Request $request){
        //dd($request->all());

        $param=$request->all();
       // dd($param);
        $Parray=array();
        for($i=1;$i<=$param['blockcount'];$i++) {
            $Parray['producer_name']=$param['producer_name'.$i];
            $Parray['producer_content']=$param['editor'.$i];

            if(isset($param['producer_images'.$i])){
                $producerimg=array();
                foreach ($param['producer_images'.$i] as $k => $file) {
                    $filename=time().'producer'.$i.$k.'.'.$file->getClientOriginalExtension();
                    $file->move(base_path().'/public/producer/pages_img',$filename);
                    $producerimg['image'][$k]=$filename;
                 
                }
                $Parray['images']=$producerimg;
                $producerimg=[];
            }
            
            if(isset($param['producer_pdf_file'.$i])){
                    $file=time().'producerfile'.$i.'.'.$request->file('producer_pdf_file'.$i)->getClientOriginalExtension();
                    $request->file('producer_pdf_file'.$i)->move(base_path().'/public/producer/pdffile',$file);
                    $Parray['producer_file']=$file;
            }
            if(isset($param['producer_id'.$i]) && $param['producer_id'.$i]!=""){
               $Parray['producer_id']=$param['producer_id'.$i]; 
               $updateProducer=General::UpdateProducers($Parray);
            }else{
                $insertProducer=General::InsertProducers($Parray);
            }
        }

        \Session::flash('alert-class','alert-success');
        \Session::flash('message','producer page content edited Successfully.!!');
        return redirect('admin/dashboard');
    }

    public function getDeleteProducer(){
        $id=\Input::get('id');
        $deleteProducer=General::deleteProducer($id);
        return $deleteProducer;
    }

    public function getResetAdminPassword(){

        return view('vendor.adminlte.auth.reset_password');
    }

    public function postResetAdminPassword(Request $request){
        $param=$request->all();
        $validator=\Validator::make($param,\Validation::get_rules("admin","reset_admin_password"));
        if($validator->fails()){
            return \Redirect::to('admin/password/reset')->withInput($param)->withErrors($validator);
        }

        $adminResetPass=Admin::reset_admin_password($param);
        if($adminResetPass){
            \Session::flash("status","Password Reset Successfully.!!");    
            return redirect("admin/password/reset");
        }else{
            return redirect("admin/password/reset")->withErrors(['email'=>'Your email address does not match with our records.']);
        }

        
        
    }
}
