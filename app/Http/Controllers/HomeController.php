<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['Buyer', 'Seller','Buyer And Seller']);
        return view('home');
    }

    public function postResetPassword(){
        $param=\Input::all();
        $validator= \Validator::make($param,\Validation::get_rules("common","reset-password"));
        if($validator->fails()){
            return \Redirect::back()
                ->withErrors($validator);
        }
        $param['usertype']=strtolower(\Auth::user()->roles[0]->name);
        if(\Auth::user()->email == $param['email']){
           $updatePass=\App\User::UpdatePassword($param);
            \Session::flash('message', 'Reset Password Successfully!!');
            \Session::flash('alert-class', 'alert-success');
            return \Redirect('/'.$param['usertype'].'/myaccount');
        }else{
            \Session::flash('message', 'You Are Not Authorized !!');
            \Session::flash('alert-class', 'alert-danger');
            return \Redirect::back();
        }


    }
}
