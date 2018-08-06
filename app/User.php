<?php

namespace App;
use App\Role;
use App\Profiles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id',
        'first_name','last_name','position','username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','remember_token',
    ];

    public function ScopeActive($query){
        return $query->where('status','Active');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function profiles(){
        return $this->belongsTo('App\Profiles','id','user_id');
    }

    public function authorizeRoles($roles)
    {

        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public static function getUser($id){
        
        return  self::where('id',$id)->with('profiles')->get();
    }

    public static function UpdateUser($param){
        $user_id=$param['user_id'];
        unset($param['user_id']);
        return self::where('id',$user_id)->update($param);

    }

    public static function UpdatePassword($param){
        return self::where('email',$param['email'])->update(array('password'=>bcrypt($param['password']),'remember_token'=>Str::random(60)));

    }

    public static function getUserNameByDId($did){

         $Record=self::where('id',$did)->select('first_name')->get();
         return $Record[0]->first_name;
    }

    public static function getUserEmailByDId($did){
         $Record=self::where('id',$did)->select('email')->get();
         return $Record[0]->email;   
    }

    //admin panel

    public static function getVendorsUser(){
        $records=self::whereHas('roles' , function($q){
            $q->whereIn('name', array('Seller','Buyer And Seller'));
        })->get()->toArray();

        $array=array();
        foreach ($records as $key=> $user){
            $array[$key]['created_at']=date('d-m-Y',strtotime($user['created_at']));
            $array[$key]['user_id']=$user['id'];
            $array[$key]['full_name']=$user['first_name']." ".$user['last_name'];
            $array[$key]['email']=$user['email'];
            $array[$key]['posts']=\App\Diamonds::postCount($user['id']);
            $array[$key]['status']=$user['status'];
        }

        return $array;
    }

    public static function getSellersUser(){
        $records=self::whereHas('roles' , function($q){
            $q->where('name', 'seller');
        })->get()->toArray();
        
        $array=array();
        foreach ($records as $key=> $user){
            $array[$key]['created_at']=date('d-m-Y',strtotime($user['created_at']));
            $array[$key]['user_id']=$user['id'];
            $array[$key]['full_name']=$user['first_name']." ".$user['last_name'];
            $array[$key]['email']=$user['email'];
            $array[$key]['posts']=\App\Diamonds::postCount($user['id']);
            $array[$key]['status']=$user['status'];
        }

        return $array;
    }

    public static function getBuyersUser(){
        $records=self::whereHas('roles' , function($q){
            $q->where('name', 'buyer');
        })->get()->toArray();

        $array=array();
        foreach ($records as $key=> $user){
            $array[$key]['created_at']=date('d-m-Y',strtotime($user['created_at']));
            $array[$key]['user_id']=$user['id'];
            $array[$key]['full_name']=$user['first_name']." ".$user['last_name'];
            $array[$key]['email']=$user['email'];
            $array[$key]['posts']=\App\RequestDiamond::RequestCount($user['id']);
            $array[$key]['status']=$user['status'];
        }

        return $array;
    }

    public static function checkActiveUser($username){
        $user=self::where('username',$username)->first();

        if(isset($user))
        return $user->status;
        
    }

    public static function updateRole($userid){
        return \DB::table('role_user')->where('user_id',$userid)->update(array('role_id'=>6));    
    }
}
