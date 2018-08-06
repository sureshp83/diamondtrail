<?php

namespace App;
use App\Role;
use App\Profiles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $table="admin";
    protected $fillable = ['id',
        'first_name','last_name','username', 'email', 'password','password_string',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function doLogin($param){

        $user=self::where('username',$param['username'])->get();

        if(isset($user[0]) && count($user)>0) {
            if (\Hash::check($param['password'], $user[0]->password)) {
                \Auth::guard('admin')->attempt(array('username' => $user[0]->username, 'password' => $param['password']));
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    public static function reset_admin_password($param){
        $admin=self::where('email',$param['email'])->get();
        if($admin->count()>0){
            $password=array(
                'password'=>bcrypt($param['new_password'])
                );
            $updatePass=self::where('email',$param['email'])->update($password);
            return $updatePass;
        }else{
            return false;
        }
    }
    public static function updateprofile($param){
        return self::where('id',1)->update($param);

    }
}
