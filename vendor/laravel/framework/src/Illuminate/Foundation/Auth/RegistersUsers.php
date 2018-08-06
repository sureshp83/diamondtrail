<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Profiles;
trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        
        return view('auth.usertype');
    }

    //check unique email 
    public function CheckEmailUnique(Request $request){
        $param=$request->all();
        $email=isset($param['email'])?$param['email']:$param['s_email'];
        $data=\App\User::where('email',$email)->get();
        if(count($data))
         echo "false";    
        else
         echo "true";
    }

    //check unique username 
    public function CheckUsernameUnique(Request $request){
        $param=$request->all();
        $username=isset($param['username'])?$param['username']:$param['s_username'];
        $data=\App\User::where('username',$username)->get();
        if(count($data))
         echo "false";    
        else
         echo "true";
         
    }

    public function getBuyer(){
        $data['countries']=\DB::table('countries')->select('id','abbreviation')->get()->toArray();
        $data['company_type']=\DB::table('company_type')->select('id','name')->get()->toArray();
        return view('auth.buyerregister',$data);
    }

    public function getSeller(){
        $data['countries']=\DB::table('countries')->select('id','abbreviation')->get()->toArray();
        $data['company_type']=\DB::table('company_type')->select('id','name')->get()->toArray();
        return view('auth.sellerregister',$data);
    }

    public function getBuyerAndSeller(){
        $data['countries']=\DB::table('countries')->select('id','abbreviation')->get()->toArray();
        $data['company_type']=\DB::table('company_type')->select('id','name')->get()->toArray();
        return view('auth.buyerandsellerregister',$data);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postBuyer(Request $request)
    {
        
        $this->validator($request->all())->validate();
       // dd($request->all());

        $param=$request->all();

        $userData=array(
            'first_name'=>$param['first_name'],
            'last_name'=>$param['last_name'],
            'username'=>$param['username'],
            'password'=>bcrypt($param['password']),
            'email'=>$param['email'],
            'position'=>$param['position'],
            'usertype'=>$param['usertype'],
            'status'=>'Uncomplete'
        );

        event(new Registered($user = $this->create($userData)));
        $fileNameMem=null;
        $fileNameInc=null;
        if($request->hasFile('incorporation_certificate')){
            $fileNameInc = $user->id . time().'inc.' .
                $request->file('incorporation_certificate')->getClientOriginalExtension();

            $request->file('incorporation_certificate')->move(
                base_path() . '/public/uploads/pdf', $fileNameInc
            );
        }
        if($request->hasFile('memorandom_certificate')){
            $fileNameMem = $user->id . time().'mem.' .
                $request->file('memorandom_certificate')->getClientOriginalExtension();

            $request->file('memorandom_certificate')->move(
                base_path() . '/public/uploads/pdf', $fileNameMem
            );
        }

        /*if($param['other_type']!=""){
            $create_comp_type=\App\General::CreateComp_type($param['other_type']);
            $param['type_of_company']=$create_comp_type;
        }*/
        $companyData=array(
            'user_id'=>$user->id,
            'company_name'=>$param['company_name'],
            'company_address_1'=>$param['company_address_1'],
            'company_address_2'=>$param['company_address_2'],
            'city'=>$param['city'],
            'country_id'=>$param['country_id'],
            'province_id'=>$param['province_id'],
            'postal_code'=>$param['postal_code'],
            'company_phone'=>$param['company_phone'],
            'company_web'=>$param['company_web'],
            'type_of_company'=>$param['type_of_company'],
            'incorporation_certificate'=>$fileNameInc,
            'memorandom_certificate'=>$fileNameMem,
            'other_typeof_company'=>null,
            'status'=>'Uncomplete'
        );  
        if($param['type_of_company']==6){
            $companyData['other_typeof_company']=$param['other_type'];    
        }

        $companyprofile=Profiles::CreateProfile($companyData);
        $this->guard()->login($user);
        \Session::flash('message', 'You are Registered Successfully!!');
        \Session::flash('alert-class', 'alert-success');
        /*return $this->registered($request, $user)
            ?: redirect($this->redirectPath());*/
        return $this->registered($request, $user)
            ?: redirect('/');
    }

    public function postSeller(Request $request)
    {
        $this->validator($request->all())->validate();

        $param=$request->all();
        //dd($param);
        $userData=array(
            'first_name'=>$param['first_name'],
            'last_name'=>$param['last_name'],
            'username'=>$param['username'],
            'password'=>bcrypt($param['password']),
            'email'=>$param['email'],
            'position'=>$param['position'],
            'usertype'=>$param['usertype'],
            'status'=>'Uncomplete'
        );

        event(new Registered($user = $this->create($userData)));
        $fileNameMem=null;
        $fileNameInc=null;
        $fileNameAccRLC=null;
        $fileNameAccProv=null;
        if($request->hasFile('incorporation_certificate')){
            $fileNameInc = $user->id . time().'inc.' .
                $request->file('incorporation_certificate')->getClientOriginalExtension();

            $request->file('incorporation_certificate')->move(
                base_path() . '/public/uploads/pdf', $fileNameInc
            );
        }
        if($request->hasFile('memorandom_certificate')){
            $fileNameMem = $user->id . time().'mem.' .
                $request->file('memorandom_certificate')->getClientOriginalExtension();

            $request->file('memorandom_certificate')->move(
                base_path() . '/public/uploads/pdf', $fileNameMem
            );
        }
        if($request->hasFile('acc_rlc_certificate')){
            $fileNameAccRLC = $user->id . time().'rlc.' .
                $request->file('acc_rlc_certificate')->getClientOriginalExtension();

            $request->file('acc_rlc_certificate')->move(
                base_path() . '/public/uploads/pdf', $fileNameAccRLC
            );
        }
        if($request->hasFile('acc_prov_certificate')){
            $fileNameAccProv = $user->id . time().'prov.' .
                $request->file('acc_prov_certificate')->getClientOriginalExtension();

            $request->file('acc_prov_certificate')->move(
                base_path() . '/public/uploads/pdf', $fileNameAccProv
            );
        }
        /*if($param['other_type']!=""){
            $create_comp_type=\App\General::CreateComp_type($param['other_type']);
            $param['type_of_company']=$create_comp_type;
        }*/
        $companyData=array(
            'user_id'=>$user->id,
            'company_name'=>$param['company_name'],
            'company_address_1'=>$param['company_address_1'],
            'company_address_2'=>$param['company_address_2'],
            'city'=>$param['city'],
            'country_id'=>$param['country_id'],
            'province_id'=>$param['province_id'],
            'postal_code'=>$param['postal_code'],
            'company_phone'=>$param['company_phone'],
            'company_web'=>$param['company_web'],
            'type_of_company'=>$param['type_of_company'],
            'incorporation_certificate'=>$fileNameInc,
            'memorandom_certificate'=>$fileNameMem,
            'acc_rlc_certificate'=>$fileNameAccRLC,
            'acc_prov_certificate'=>$fileNameAccProv,
            'other_typeof_company'=>null,
            'status'=>'Uncomplete'
        );
        if($param['type_of_company']==6){
            $companyData['other_typeof_company']=$param['other_type'];    
        }
        $companyprofile=Profiles::CreateProfile($companyData);
        $this->guard()->login($user);

        /*return $this->registered($request, $user)
            ?: redirect($this->redirectPath());*/
        \Session::flash('message', 'You are Registered Successfully!!');
        \Session::flash('alert-class', 'alert-success');    
        return $this->registered($request, $user)
            ?: redirect('/');
    }

    public function postBuyerAndSeller(Request $request){
        $param=$request->all();
        //dd($param);
        if($param['same-info']=="on"){

            $validator=array(
                'company_name'=>$param['company_name'],
                'company_address_1'=>$param['company_address_1'],
                'city'=>$param['city'],
                'country_id'=>$param['country_id'],
                'province_id'=>$param['province_id'],
                'postal_code'=>$param['postal_code'],
                'company_phone'=>$param['company_phone'],
                'username'=>$param['username'],
                'password'=>bcrypt($param['password']),
                'first_name'=>$param['first_name'],
                'last_name'=>$param['last_name'],
                'email'=>$param['email']
            );
            $this->validator($validator)->validate();


            // Both Type of user Buyer and seller manage by single entry
            $userData=array(
                'username'=>$param['username'],
                'password'=>bcrypt($param['password']),
                'first_name'=>$param['first_name'],
                'last_name'=>$param['last_name'],
                'email'=>$param['email'],
                'position'=>$param['position'],
                'usertype'=>"Buyer And Seller",
                'status'=>'Uncomplete'
            );

            event(new Registered($user = $this->create($userData)));

            $fileNameMem=null;
            $fileNameInc=null;
            $fileNameAccRLC=null;
            $fileNameAccProv=null;
            if($request->hasFile('incorporation_certificate')){
                $fileNameInc = $user->id . time().'inc.' .
                    $request->file('incorporation_certificate')->getClientOriginalExtension();

                $request->file('incorporation_certificate')->move(
                    base_path() . '/public/uploads/pdf', $fileNameInc
                );
            }
            if($request->hasFile('memorandom_certificate')){
                $fileNameMem = $user->id . time().'mem.' .
                    $request->file('memorandom_certificate')->getClientOriginalExtension();

                $request->file('memorandom_certificate')->move(
                    base_path() . '/public/uploads/pdf', $fileNameMem
                );
            }

            if($request->hasFile('acc_rlc_certificate')){
                $fileNameAccRLC = $user->id . time().'rlc.' .
                    $request->file('acc_rlc_certificate')->getClientOriginalExtension();

                $request->file('acc_rlc_certificate')->move(
                    base_path() . '/public/uploads/pdf', $fileNameAccRLC
                );
            }
            if($request->hasFile('acc_prov_certificate')){
                $fileNameAccProv = $user->id . time().'prov.' .
                    $request->file('acc_prov_certificate')->getClientOriginalExtension();

                $request->file('acc_prov_certificate')->move(
                    base_path() . '/public/uploads/pdf', $fileNameAccProv
                );
            }
            /*if($param['other_type']!=""){
                $create_comp_type=\App\General::CreateComp_type($param['other_type']);
                $param['type_of_company']=$create_comp_type;
            }*/
            $companyData=array(
                'user_id'=>$user->id,
                'company_name'=>$param['company_name'],
                'company_address_1'=>$param['company_address_1'],
                'company_address_2'=>$param['company_address_2'],
                'city'=>$param['city'],
                'country_id'=>$param['country_id'],
                'province_id'=>$param['province_id'],
                'postal_code'=>$param['postal_code'],
                'company_phone'=>$param['company_phone'],
                'company_web'=>$param['company_web'],
                'type_of_company'=>$param['type_of_company'],
                'incorporation_certificate'=>$fileNameInc,
                'memorandom_certificate'=>$fileNameMem,
                'acc_rlc_certificate'=>$fileNameAccRLC,
                'acc_prov_certificate'=>$fileNameAccProv,
                'other_typeof_company'=>null,
                'status'=>'Uncomplete'
            );

            if($param['type_of_company']==6){
                $companyData['other_typeof_company']=$param['other_type'];    
            }

            $companyprofile=Profiles::CreateProfile($companyData);
            $this->guard()->login($user);
            \Session::flash('message', 'You are Registered Successfully!!');
            \Session::flash('alert-class', 'alert-success');
            return $this->registered($request, $user)
                ?: redirect($this->redirectPath());

        }else{

            // Different Type of user Buyer and seller manage by double entry

            // Buyer Account detail
            //dd($param);
            $validator=array(
                'username'=>$param['username'],
                'email'=>$param['email']
            );
            $this->validator($validator)->validate();

            $userData=array(
                'first_name'=>$param['first_name'],
                'last_name'=>$param['last_name'],
                'username'=>$param['username'],
                'password'=>bcrypt($param['password']),
                'email'=>$param['email'],
                'position'=>$param['position'],
                'usertype'=>"Buyer",
                'status'=>'Uncomplete'
            );

            event(new Registered($buser = $this->create($userData)));

            $fileNameMem=null;
            $fileNameInc=null;
            if($request->hasFile('incorporation_certificate')){
                $fileNameInc = $buser->id . time().'inc.' .
                    $request->file('incorporation_certificate')->getClientOriginalExtension();

                $request->file('incorporation_certificate')->move(
                    base_path() . '/public/uploads/pdf', $fileNameInc
                );
            }
            if($request->hasFile('memorandom_certificate')){
                $fileNameMem = $buser->id . time().'mem.' .
                    $request->file('memorandom_certificate')->getClientOriginalExtension();

                $request->file('memorandom_certificate')->move(
                    base_path() . '/public/uploads/pdf', $fileNameMem
                );
            }
            /*if($param['other_type']!=""){
                $create_comp_type=\App\General::CreateComp_type($param['other_type']);
                $param['type_of_company']=$create_comp_type;
            }*/
            $companyData=array(
                'user_id'=>$buser->id,
                'company_name'=>$param['company_name'],
                'company_address_1'=>$param['company_address_1'],
                'company_address_2'=>$param['company_address_2'],
                'city'=>$param['city'],
                'country_id'=>$param['country_id'],
                'province_id'=>$param['province_id'],
                'postal_code'=>$param['postal_code'],
                'company_phone'=>$param['company_phone'],
                'company_web'=>$param['company_web'],
                'type_of_company'=>$param['type_of_company'],
                'incorporation_certificate'=>$fileNameInc,
                'memorandom_certificate'=>$fileNameMem,
                'other_typeof_company'=>null,
                'status'=>'Uncomplete'
            );
            if($param['type_of_company']==6){
                $companyData['other_typeof_company']=$param['other_type'];    
            }
            $companyprofile=Profiles::CreateProfile($companyData);


            // Seller Account detail

            $validator=array(
                'username'=>$param['s_username'],
                'email'=>$param['s_email']
            );

            $this->validator($validator)->validate();

            $userData=array(
                'first_name'=>$param['s_first_name'],
                'last_name'=>$param['s_last_name'],
                'username'=>$param['s_username'],
                'password'=>bcrypt($param['s_password']),
                'email'=>$param['s_email'],
                'position'=>$param['s_position'],
                'usertype'=>"Seller",
                'status'=>'Uncomplete'
            );
            event(new Registered($suser = $this->create($userData)));

            $fileNameMem=null;
            $fileNameInc=null;
            $fileNameAccRLC=null;
            $fileNameAccProv=null;
            if($request->hasFile('s_incorporation_certificate')){
                $fileNameInc = $suser->id . time().'inc.' .
                    $request->file('s_incorporation_certificate')->getClientOriginalExtension();

                $request->file('s_incorporation_certificate')->move(
                    base_path() . '/public/uploads/pdf', $fileNameInc
                );
            }
            if($request->hasFile('s_memorandom_certificate')){
                $fileNameMem = $suser->id . time().'mem.' .
                    $request->file('s_memorandom_certificate')->getClientOriginalExtension();

                $request->file('s_memorandom_certificate')->move(
                    base_path() . '/public/uploads/pdf', $fileNameMem
                );
            }
            if($request->hasFile('acc_rlc_certificate')){
                $fileNameAccRLC = $suser->id . time().'rlc.' .
                    $request->file('acc_rlc_certificate')->getClientOriginalExtension();

                $request->file('acc_rlc_certificate')->move(
                    base_path() . '/public/uploads/pdf', $fileNameAccRLC
                );
            }
            if($request->hasFile('acc_prov_certificate')){
                $fileNameAccProv = $suser->id . time().'prov.' .
                    $request->file('acc_prov_certificate')->getClientOriginalExtension();

                $request->file('acc_prov_certificate')->move(
                    base_path() . '/public/uploads/pdf', $fileNameAccProv
                );
            }
            /*if($param['s_other_type']!=""){
                $create_comp_type=\App\General::CreateComp_type($param['other_type']);
                $param['s_type_of_company']=$create_comp_type;
            }*/
            $companyData=array(
                'user_id'=>$suser->id,
                'company_name'=>$param['s_company_name'],
                'company_address_1'=>$param['s_company_address_1'],
                'company_address_2'=>$param['s_company_address_2'],
                'city'=>$param['s_city'],
                'country_id'=>$param['s_country_id'],
                'province_id'=>$param['s_province_id'],
                'postal_code'=>$param['s_postal_code'],
                'company_phone'=>$param['s_company_phone'],
                'company_web'=>$param['s_company_web'],
                'type_of_company'=>$param['s_type_of_company'],
                'incorporation_certificate'=>$fileNameInc,
                'memorandom_certificate'=>$fileNameMem,
                'acc_rlc_certificate'=>$fileNameAccRLC,
                'acc_prov_certificate'=>$fileNameAccProv,
                'other_typeof_company'=>null,
                'status'=>'Uncomplete'
            );
            if($param['type_of_company']==6){
                $companyData['other_typeof_company']=$param['s_other_type'];    
            }
            
            $companyprofile=Profiles::CreateProfile($companyData);
            $this->guard()->login($suser);
            \Session::flash('message', 'You are Registered Successfully!!');
            \Session::flash('alert-class', 'alert-success');
            return $this->registered($request, $suser)
                ?: redirect($this->redirectPath());
        }

    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
