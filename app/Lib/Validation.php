<?php

namespace App\lib;

class Validation
{

    private static $rules = array(
        "buyer" => array(
            "editprofile" => array(
                'company_name' => 'required|string|max:255',
                'company_address_1' => 'required|string|max:255',
                'city'=>'required|string|max:255',
                'country_id'=>'required|numeric',
                'province_id'=>'required|numeric',
                'postal_code'=>'required|string|max:6',
                'company_phone' => 'required|numeric',
                'first_name'=>'required|string|max:255',
                'last_name'=>'required|string|max:255',
                'email' => 'required|string|email|max:255',
            ),
            "post-diamond-step-1"=>array(
                'country_id'=>'required',
                'mine_id'=>'required',
                'producer_id'=>'required',
                'carat_min'=>'required',
                'carat_max'=>'required',
                'brand_id'=>'required',
                'certification_laboratories_id'=>'required',
            ),
        ),
        "seller" => array(
            "editprofile" => array(
                'company_name' => 'required|string|max:255',
                'company_address_1' => 'required|string|max:255',
                'city'=>'required|string|max:255',
                'country_id'=>'required|numeric',
                'province_id'=>'required|numeric',
                'postal_code'=>'required|string|max:6',
                'company_phone' => 'required|numeric',
                'first_name'=>'required|string|max:255',
                'last_name'=>'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
            ),
            "post-diamond-step-1"=>array(
                'country_id'=>'required',
                'mine_id'=>'required',
                'producer_id'=>'required',
                'price'=>'required',
                'totalprice'=>'required',
                'carat'=>'required',
                'brand_id'=>'required',
                'certification_laboratories_id'=>'required',
                'certificate_number'=>'required',
                /*'diamond_certi_file'=>'required|file',
                'diamond_images'=>'required|max:4'*/
            ),
            "upload-csv-1"=>array(
                 'upload_csv_seller'=>'required'   
            ),
            "upload-csv-2"=>array(
                 'upload_dmgimg_seller'=>'required' 
            ),
            "upload-csv-3"=>array(
                  'upload_dmgpdf_seller'=>'required'  
            ),
        ),
        "common"=>array(
            "reset-password"=>array(
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:6'
            ),
            "contact-us"=>array(
                'company_name'=>'required',
                'full_name'=>'required',
                'email'=>'required|email|unique:contact_us,email',
                'phone_no'=>'required|numeric',
                'subject'=>'required',
                'message'=>'required'
                ),
        ),
        "admin"=>array(
            "login"=>array(
                'username'=>'required',
                'password'=>'required|min:6'
            ),
            "reset_password"=>array(
                'new_password'=>'required|min:6',
                'cnf_password'=>'required_with:password|same:new_password|min:6'
            ),
            "reset_admin_password"=>array(
                'new_password'=>'required|min:6',
                'confirmation_password'=>'required_with:password|same:new_password|min:6'
            ),
            "editdiamond"=>array(
                'country_id'=>'required',
                'mine_id'=>'required',
                'producer_id'=>'required',
                'price'=>'required',
                'totalprice'=>'required',
                'carat'=>'required',
                'brand_id'=>'required',
                'certification_laboratories_id'=>'required',
                'certificate_number'=>'required',                
            ),
        ),
    );

    public static function get_rules($type, $rules_name)
    {
        if (isset(self::$rules[$type][$rules_name]))
            return self::$rules[$type][$rules_name];

        return array();
    }
}
?>