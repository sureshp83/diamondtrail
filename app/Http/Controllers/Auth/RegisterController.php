<?php

namespace App\Http\Controllers\Auth;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    
    use RegistersUsers;
    
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'company_name' => 'required|string|max:255',
            'company_address_1' => 'required|string|max:255',
            'city'=>'required|string|max:255',
            'country_id'=>'required|numeric',
            'province_id'=>'required|numeric',
            'postal_code'=>'required|string|min:6',
            'company_phone' => 'required|numeric',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
    }

    protected function Bothvalidator(array $data){
        //dd($data);
        return Validator::make($data, [
            'company_name' => 'required|string|max:255',
            'company_address_1' => 'required|string|max:255',
            'city'=>'required|string|max:255',
            'company_phone' => 'required|numeric',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            's_company_name'=>'required|string|max:255',
            's_company_address_1' => 'required|string|max:255',
            's_city'=>'required|string|max:255',
            's_company_phone' => 'required|numeric',
            's_username' => 'required|string|max:255|unique:users',
            's_password' => 'required|string|min:6',
            's_first_name'=>'required|string|max:255',
            's_last_name'=>'required|string|max:255',
            's_email' => 'required|string|email|max:255|unique:users',
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create($data);
        $user
            ->roles()
            ->attach(Role::where('name',$data['usertype'])->first());
            
            //send user register mail
             \Mail::send('emails.welcome', $data, function($message) use ($data)
            {
                $message->subject("Welcome to Diamondtrail");
                $message->to($data['email']);
            });
            \Log::info("mail send");    
        return $user;
    }
}
