<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Profiles extends Model
{
    public $table="profiles";
    protected $fillable=['user_id','company_name','company_address_1','company_address_2','city','country_id','province_id','company_phone','postal_code','company_web','type_of_company','other_typeof_company','incorporation_certificate','memorandom_certificate','acc_rlc_certificate','acc_prov_certificate','created_at','updated_at'];



    public static function CreateProfile($param){

        $profile=new Profiles();
        self::create($param);
        return $profile;
    }

    public static function UpdateComapny($param){
        $comp_id=$param['comp_id'];
        unset($param['comp_id']);
        $updateprofile=self::where('id',$comp_id)->update($param);
        return $comp_id;
    }

    public static function getCompNameByDId($user_id){
        $Record=self::where('user_id',$user_id)->select('company_name')->get();
        return $Record[0]->company_name;
    }

    public static function getCompTelNoByDId($user_id){
        $Record=self::where('user_id',$user_id)->select('company_phone')->get();
        return $Record[0]->company_phone;
    }
}
