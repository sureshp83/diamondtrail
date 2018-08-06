<?php

namespace App\Http\Controllers;
use App\User;
use App\General;
use App\Profiles;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function landing () {
        if(!\Auth::check()){
            $data['diamonds']=\App\Diamonds::Active()->count();
            $data['sellers']=User::whereHas('roles' , function($q){
            $q->where('name', 'seller');
        })->count();
            $data['buyers']=User::whereHas('roles' , function($q){
            $q->where('name', 'buyer');
        })->count();
            //dd($content);
            return view('pages.landing',$data);     
        }
        else{
            return view('pages.logged_landing');        
        }
        
    }

    public function LoadProvince(Request $request){
        $data['province']=\DB::table('provinces')->select('id','name')->where('country_id',$request->id)->get()->toArray();
        return \Response::json($data,200);
    }

    public function getProducers(){
        $data['producers']=General::getProducersContent();
        return view('pages.producers',$data);
    }

    public function getSingleProducers($id){
        $data=General::getSingleProducer($id);
        //dd($data);
        return view('pages.single_producer',$data);
    }

    public function AboutUs(){
        $data['content']=General::getPagesContentByType('about-us');
        return view('pages.about',$data);
    }

    public function getContactUs(){
        return view('pages.contact');
    }
    public function postContactUs(Request $request){
        $param=\Input::all();
        $validator=\Validator::make($param,\Validation::get_rules("common","contact-us"));
        if($validator->fails()){

            return \Redirect::to('contact-us')->withInput($param)->withErrors($validator);
        }
        event(new \App\Events\ContactUs($param));
        \Session::flash('alert-class','alert-success');
        \Session::flash('message','Your detail submited successfully.');
        return Redirect('contact-us');

        
    }

    public function Traceability(){
        $data['content']=General::getPagesContentByType('traceability');
        return view('pages.traceability',$data);
    }
}
