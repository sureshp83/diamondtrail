<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestDiamond extends Model
{
    protected $table="request_diamonds";
    protected $fillable = ['user_id', 'clarity_type_id', 'color_id', 'intensity_id', 'cut_type_id',
        'shape_id', 'florescence_type_id', 'certification_laboratory_id', 'origin', 'brand_id', 'carat_min', 'carat_max', 'status','comments',
        'created_at', 'updated_at'];


    public function ScopeActive($query){
        return $query->where('status','Active');
    }
    public function ScopeNotUncomplate($query){
        return $query->where('status','!=','Uncomplete');
    }

    public static function RequestCount($user_id){
            return self::where('user_id',$user_id)->count();
        }

    public static function create_diamond($param)
    {
        //dd($param);

        $record=self::create($param);
        return $record->id;
    }

    public static function update_diamond($param){
        $diamond_id=$param['diamond_id'];
        unset($param['diamond_id']);
        $record=self::where('id',$diamond_id)->update($param);
        return $diamond_id;
    }

    public static function getRequestDiamond($id,$auth=false)
    {

        if($auth){
            $whereArr=array('request_diamonds.id'=>$id,'user_id'=>\Auth::user()->id);
        }else{
            $whereArr=array('request_diamonds.id'=>$id);
            }
        $record = self::where($whereArr)
            /*->join('clarity_types', 'clarity_types.id', '=', 'clarity_type_id')
            ->join('cut_types', 'cut_types.id', '=', 'cut_type_id')
            ->join('shapes', 'shapes.id', '=', 'shape_id')
            ->join('florescence_types', 'florescence_types.id', '=', 'florescence_type_id')
            ->join('certification_laboratories', 'certification_laboratories.id', '=', 'certification_laboratory_id')
            ->join('brands', 'brands.id', '=', 'brand_id')
            ->select('request_diamonds.*','clarity_types.label as clarity_type_label','cut_types.label as cut_type_label','shapes.label as shape_label','florescence_types.label as florescence_type_label','certification_laboratories.label as certification_laboratory_label','brands.label as brand_label')*/
            ->select('request_diamonds.*')

            ->get()->toArray();
        //dd($record);    
        if(isset($record[0])) {
            if ($record[0]['intensity_id'] == null) {
                $colorArr = unserialize($record[0]['color_id']);

                $getcoor = General::getLabel('colors',$colorArr['color_id']); /*\DB::table('colors')->whereIn('id', explode(',',$colorArr['color_id']))->select('id', 'label')->get()->toArray();*/

                $record[0]['color_id'] = $colorArr['color_id'];
                $record[0]['color_label'] = $getcoor;

            } else {
                $intensity = \DB::table('intensity')->whereIn('id', explode(',', $record[0]['intensity_id']))->select('name as intensity_label')->get();

                $colorArr = unserialize($record[0]['color_id']);
                $colorArr = array($colorArr['color_id_1'], $colorArr['color_id_2'], $colorArr['color_id_3']);
                $getcoor = \DB::table('colors')->whereIn('id', $colorArr)->select('label')->get()->toArray();
                $getcoor = array_column($getcoor, 'label');
                $record[0]['fancy_color_gp'] = $colorArr;
                $record[0]['color_label'] = $intensity[0]->intensity_label . '-' . implode(',', $getcoor);
                $record[0]['color_id']=null;
                // dd($record);
            }
        }
        $record[0]['clarity_type_label']=General::getLabel('clarity_types',$record[0]['clarity_type_id']);
        $record[0]['cut_type_label']=General::getLabel('cut_types',$record[0]['cut_type_id']);
        $record[0]['florescence_type_label']=General::getLabel('florescence_types',$record[0]['florescence_type_id']);
        $record[0]['certification_laboratory_label']=General::getLabel('certification_laboratories',$record[0]['certification_laboratory_id']);
        $record[0]['brand_label']=General::getLabel('brands',$record[0]['brand_id']);
        $record[0]['shape_label']=General::getLabel('shapes',$record[0]['shape_id']);
        $record[0]['user_name']=\App\User::getUserNameByDId($record[0]['user_id']);
        $record[0]['user_email']=\App\User::getUserEmailByDId($record[0]['user_id']);
        $record[0]['comp_name']=\App\Profiles::getCompNameByDId($record[0]['user_id']);
        $record[0]['comp_telno']=\App\Profiles::getCompTelNoByDId($record[0]['user_id']);
        $origin=explode(',',$record[0]['origin']);
        foreach ($origin as $k=> $arr){
            $org=explode('-',$arr);
            $record[0]['country_id'][$k]=$org[0];
            $record[0]['producer_id'][$k]=$org[1];
            $record[0]['mine_id'][$k]=$org[2];
        }
        //dd($record);
        return $record;
    }

    public static function post_diamond($id){
        $record=self::where('id',$id)->update(array('status'=>'Active'));
        return $record;
    }

    public static function getActiveRequest($id=""){

        $record = self::Active();
            if($id){
                $record=$record->where('user_id',$id);
            }

        $record=$record->join('clarity_types', 'clarity_types.id', '=', 'clarity_type_id')
            ->join('cut_types', 'cut_types.id', '=', 'cut_type_id')
            ->join('shapes', 'shapes.id', '=', 'shape_id')
            ->join('florescence_types', 'florescence_types.id', '=', 'florescence_type_id')
            ->join('certification_laboratories', 'certification_laboratories.id', '=', 'certification_laboratory_id')
            ->join('brands', 'brands.id', '=', 'brand_id')
            ->select('request_diamonds.*','clarity_types.label as clarity_type_label','cut_types.label as cut_type_label','shapes.label as shape_label','florescence_types.label as florescence_type_label','certification_laboratories.label as certification_laboratory_label','brands.label as brand_label')->orderBy('id','desc')
            ->get()->toArray();

        $dataArray=array();
        foreach ($record as $key => $rec){
            $dataArray[$key]['clarity_type_label']=General::getLabel('clarity_types',$rec['clarity_type_id']);
            $dataArray[$key]['cut_type_id']=General::getLabel('cut_types',$rec['cut_type_id']);
            $dataArray[$key]['florescence_type_label']=General::getLabel('florescence_types',$rec['florescence_type_id']);
            $dataArray[$key]['shape_label']=General::getLabel('shapes',$rec['shape_id']);

            $dataArray[$key]['created_at']=date('d-m-Y',strtotime($rec['created_at']));
            $dataArray[$key]['id']=$rec['id'];
            $dataArray[$key]['origin']=$rec['origin'];

            $dataArray[$key]['carat_min']=$rec['carat_min'];
            $dataArray[$key]['carat_max']=$rec['carat_max'];

            $dataArray[$key]['intensity_id']=$rec['intensity_id'];
            $dataArray[$key]['cut_type_label']=$rec['cut_type_label'];
            $dataArray[$key]['florescence_type_label']=$rec['florescence_type_label'];

            if ($rec['intensity_id'] == null) {
                $colorArr = unserialize($rec['color_id']);
                $getcoor = \DB::table('colors')->where('id', $colorArr['color_id'])->select('id', 'label')->get();
                $dataArray[$key]['color_id'] = $getcoor[0]->id;
                $dataArray[$key]['color_label'] = $getcoor[0]->label;

            } else {
                $intensity = \DB::table('intensity')->where('id', explode(',', $rec['intensity_id']))->select('name as intensity_label')->get();
                $colorArr = unserialize($rec['color_id']);
                $colorArr = array($colorArr['color_id_1'], $colorArr['color_id_2'], $colorArr['color_id_3']);
                $getcoor = \DB::table('colors')->whereIn('id', $colorArr)->select('label')->get()->toArray();
                $getcoor = array_column($getcoor, 'label');
                $dataArray[$key]['fancy_color_gp'] = $colorArr;
                $dataArray[$key]['color_id'] = $intensity[0]->intensity_label . '-' . implode(',', $getcoor);
                //dd($record);
            }
        }
        return $dataArray;
    }
    //search request
    public static function getRequestByAjaxCall($param){
        $record = self::Active();
        
        $filtersection=$param['filtersection'];

        //shape filter

        if(isset($filtersection['shapeFilter']) && $filtersection['shapeFilter']!=null)
            $record=$record->whereIn('shape_id',$filtersection['shapeFilter']);

        //cut type

        
        if(isset($filtersection['cutFilter']['cut_type_start']) && $filtersection['cutFilter']['cut_type_start'] !=null) {
            $record =$record->whereRaw("substr(cut_type_id,1,1) >= ".$filtersection['cutFilter']['cut_type_start']);
        }                           

        if(isset($filtersection['cutFilter']['cut_type_end']) && $filtersection['cutFilter']['cut_type_end'] !=null) {
            $record =$record->whereRaw("substr(cut_type_id,3,1) <= ".$filtersection['cutFilter']['cut_type_end']);
            //$record =$record->where('cut_type_id', '<=', $filtersection['cutFilter']['cut_type_end']);
        }
        
        //carat filter

        if(isset($filtersection['caratFilter']['carat_min']) && $filtersection['caratFilter']['carat_min'] !=null) {
            $record =$record->where('carat_min', '>=', $filtersection['caratFilter']['carat_min']);
        }

        if(isset($filtersection['caratFilter']['carat_max']) && $filtersection['caratFilter']['carat_max'] !=null) {

            $record =$record->where('carat_max', '<=', $filtersection['caratFilter']['carat_max']);
        }

         //clarity filter

        if(isset($filtersection['clarityFilter']['clarity_type_start']) && $filtersection['clarityFilter']['clarity_type_start'] !=null) {
            $record =$record->whereRaw("substr(clarity_type_id,1,1) >= ".$filtersection['clarityFilter']['clarity_type_start']);
            /*$record =$record->where('clarity_type_id', '>=', $filtersection['clarityFilter']['clarity_type_start']);*/
        }

        if(isset($filtersection['clarityFilter']['clarity_type_end']) && $filtersection['clarityFilter']['clarity_type_end'] !=null) {
            $record =$record->whereRaw("substr(clarity_type_id,3,1) <= ".$filtersection['clarityFilter']['clarity_type_end']);
        }

        //Fluorescence filter

        if(isset($filtersection['FluorescenceFilter']['florescence_type_start']) && $filtersection['FluorescenceFilter']['florescence_type_start'] !=null) {
            $record =$record->whereRaw("substr(florescence_type_id,1,1) >= ".$filtersection['FluorescenceFilter']['florescence_type_start']);
            /*$record =$record->where('florescence_type_id', '>=', $filtersection['FluorescenceFilter']['florescence_type_start']);*/
        }

        if(isset($filtersection['FluorescenceFilter']['florescence_type_end']) && $filtersection['FluorescenceFilter']['florescence_type_end'] !=null) {
            $record =$record->whereRaw("substr(florescence_type_id,3,1) <= ".$filtersection['FluorescenceFilter']['florescence_type_end']);
        }

        //color filter colourless
        if(isset($filtersection['colorFilter']['colorless_id']) && $filtersection['colorFilter']['colorless_id']!=null){
            $allrecordId=self::Active()->select('id')->get()->toArray();
            $allrecordId=array_column($allrecordId, 'id');

            $colorData=self::Active()->where('intensity_id',null)->select('id','color_id');
            /*if($param['record_type']=="pending"){
                $colorData=$colorData->where('status','Pending');
            }
            if($param['record_type']=="published"){
                $colorData=$colorData->where('status','Active');
            }
            if($param['record_type']=="archived"){
                $colorData=$colorData->where('status','Archived');
            }else{
                $colorData=$colorData->where('status','!=','Archived');
            }*/

            $colorData=$colorData->get()->toArray();
            
            foreach ($colorData as $key => $color) {
                $array=unserialize($color['color_id']);
                $colorids[$color['id']]=$array['color_id'];
            }
            
            foreach ($colorids as $key => $value) {
                $data=explode(',', $value);
                if(in_array($filtersection['colorFilter']['colorless_id'],$data)){
                   $colorless[]=$key;
                }
            }
            
            if(!isset($colorless))
            {
                $record=$record->whereNotIn('id',$allrecordId);
            }
        }

        //color filter fancy color
        if(isset($filtersection['colorFilter']['fancycolor_id']) && $filtersection['colorFilter']['fancycolor_id']!=null){
            $allrecordId=self::Active()->select('id')->get()->toArray();
            $allrecordId=array_column($allrecordId, 'id');

            $colorData=self::Active()->where('intensity_id','!=',null)->select('id','color_id');
            /*if($param['record_type']=="pending"){
                $colorData=$colorData->where('status','Pending');
            }
            if($param['record_type']=="published"){
                $colorData=$colorData->where('status','Active');
            }
            if($param['record_type']=="archived"){
                $colorData=$colorData->where('status','Archived');
            }else{
                $colorData=$colorData->where('status','!=','Archived');
            }*/
            $colorData=$colorData->get()->toArray();
            //dd($colorData);
            foreach ($colorData as $key => $color) {
                
                $array=unserialize($color['color_id']);
                if(in_array($filtersection['colorFilter']['fancycolor_id'],$array)){
                   $search[]= $colorData[$key]['id'];
                }
            }

            if(!isset($search)){
                $record=$record->whereNotIn('id',$allrecordId);
                //$record=$record->whereIn('id',$search);
            }
        }

        if(isset($colorless) && isset($search)){

            $merge=array_merge($colorless,$search);
            $record=$record->whereIn('id',$merge);
        }else if(isset($colorless) && !isset($search)){

            $record=$record->whereIn('id',$colorless);
        }else if(isset($search) && !isset($colorless)){

            $record=$record->whereIn('id',$search);
        }

        // price filter

        if(isset($filtersection['priceFilter']['min_price']) && $filtersection['priceFilter']['min_price'] !=null) {
            $record =$record->where('price', '>=', $filtersection['priceFilter']['min_price']);
        }

        if(isset($filtersection['priceFilter']['max_price']) && $filtersection['priceFilter']['max_price'] !=null) {
            $record =$record->where('price', '<=', $filtersection['priceFilter']['max_price']);
        }

        //totalprice filter

        if(isset($filtersection['totalPriceFilter']['total_min_price']) && $filtersection['totalPriceFilter']['total_min_price'] !=null) {
            $record =$record->where('totalprice', '>=', $filtersection['totalPriceFilter']['total_min_price']);
        }

        if(isset($filtersection['totalPriceFilter']['total_max_price']) && $filtersection['totalPriceFilter']['total_max_price'] !=null) {
            $record =$record->where('totalprice', '<=', $filtersection['totalPriceFilter']['total_max_price']);
        }

        //request_id Filter
        if(isset($filtersection['requestidFilter']['request_id']) && $filtersection['requestidFilter']['request_id'] !=null) {
            $record =$record->where('id', '=', $filtersection['requestidFilter']['request_id']);
        }

        //dropdown section
        if(isset($param['dropdownsection'])) {
            $dropdownsection=$param['dropdownsection'];

            //country_id
            if(isset($dropdownsection['dropdownFilter']['country_id']) && $dropdownsection['dropdownFilter']['country_id'] !=null) {
                $country=$dropdownsection['dropdownFilter']['country_id'];
                $record=$record->Where(function ($query) use($country) {
                    for ($i = 0; $i < count($country); $i++){
                        $query->Orwhere('origin', 'like', '%'.$country[$i] .'%');
                    }
                });
                //$record =$record->where('origin', 'LIKE', $dropdownsection['dropdownFilter']['country_id'].'%');
            }

            //producer_id
            if(isset($dropdownsection['dropdownFilter']['producer_id']) && $dropdownsection['dropdownFilter']['producer_id'] !=null) {
                $producer=$dropdownsection['dropdownFilter']['producer_id'];
                $record=$record->Where(function ($query) use($producer) {
                    for ($i = 0; $i < count($producer); $i++){
                        $query->Orwhere('origin', 'like', '%'.$producer[$i] .'%');
                        //$query->Orwhere('origin', 'like', '%-' . $producer[$i] .'%');
                    }
                });
                //$record =$record->where('origin', 'LIKE', '%-'.$dropdownsection['dropdownFilter']['producer_id'].'%');
            }
            //dd($record=$record->toSql());
            //mine_id_id
            if(isset($dropdownsection['dropdownFilter']['mine_id']) && $dropdownsection['dropdownFilter']['mine_id'] !=null) {
                $mine=$dropdownsection['dropdownFilter']['mine_id'];
                $record=$record->Where(function ($query) use($mine) {
                    for ($i = 0; $i < count($mine); $i++){
                        $query->Orwhere('origin', 'like', '%'.$mine[$i] .'%');
                        //$query->Orwhere('origin', 'like', '%-%-' . $mine[$i] .'%');
                    }
                });
                //$record =$record->where('origin', 'LIKE','%-%-'. $dropdownsection['dropdownFilter']['mine_id'].'%');
            }
        }

        //datesection
        $datesection=$param['datesection'];
        if(isset($datesection['dateFilter']['start_date']) && $datesection['dateFilter']['start_date'] !=null) {
            $date = date('Y-m-d', strtotime($datesection['dateFilter']['start_date']));
            $record =$record->where(\DB::raw('DATE(created_at)'), '>=',$date);
        }

        if(isset($datesection['dateFilter']['end_date']) && $datesection['dateFilter']['end_date'] !=null) {
            $date = date('Y-m-d', strtotime($datesection['dateFilter']['end_date']));
            $record =$record->where(\DB::raw('DATE(created_at)'), '<=',$date);
        }
        //dd($record=$record->toSql());
        $record =$record->get()->toArray();


        $dataArr=array();
        foreach ($record as $key=>$rec){

            if ($rec['intensity_id'] == null) {
                $colorArr = unserialize($rec['color_id']);

                $getcoor = General::getLabel('colors',$colorArr['color_id']); /*\DB::table('colors')->whereIn('id', explode(',',$colorArr['color_id']))->select('id', 'label')->get()->toArray();*/

                $dataArr[$key]['color_id'] = $colorArr['color_id'];
                $dataArr[$key]['color_label'] = $getcoor;

            } else {
                $intensity = \DB::table('intensity')->whereIn('id', explode(',', $rec['intensity_id']))->select('name as intensity_label')->get();

                $colorArr = unserialize($rec['color_id']);
                $colorArr = array($colorArr['color_id_1'], $colorArr['color_id_2'], $colorArr['color_id_3']);
                $getcoor = \DB::table('colors')->whereIn('id', $colorArr)->select('label')->get()->toArray();
                $getcoor = array_column($getcoor, 'label');
                $dataArr[$key]['fancy_color_gp'] = $colorArr;
                $dataArr[$key]['color_label'] = $intensity[0]->intensity_label . '-' . implode(',', $getcoor);
                // dd($record);
            }
            $dataArr[$key]['req_id']=$rec['id'];
            $dataArr[$key]['user_id']=$rec['user_id'];
            $dataArr[$key]['carat']=$rec['carat_min']."-".$rec['carat_max'];
            $dataArr[$key]['created_at']=date('d-m-Y',strtotime($rec['created_at']));
            $dataArr[$key]['origin']=$rec['origin'];
            $dataArr[$key]['clarity_type_label']=General::getLabel('clarity_types',$rec['clarity_type_id']);
            $dataArr[$key]['cut_type_label']=General::getLabel('cut_types',$rec['cut_type_id']);
            $dataArr[$key]['florescence_type_label']=General::getLabel('florescence_types',$rec['florescence_type_id']);
            $dataArr[$key]['certification_laboratory_label']=General::getLabel('certification_laboratories',$rec['certification_laboratory_id']);
            $dataArr[$key]['brand_label']=General::getLabel('brands',$rec['brand_id']);
            $dataArr[$key]['shape_label']=General::getLabel('shapes',$rec['shape_id']);
        }
        return $dataArr;
    }

    //my request
    public static function getUserRequestByAjaxCall($param){

        $record=self::NotUncomplate()->where('user_id',\Auth::user()->id);

        if($param['record_type']=="pending"){
            $record=$record->where('status','Pending');
        }
        if($param['record_type']=="published"){
            $record=$record->where('status','Active');
        }
        if($param['record_type']=="archived"){
            $record=$record->where('status','Archived');
        }
        else{
            $record=$record->where('status','!=','Archived');
        }

        $filtersection=$param['filtersection'];

        //shape filter

        if(isset($filtersection['shapeFilter']) && $filtersection['shapeFilter']!=null)
            $record=$record->whereIn('shape_id',$filtersection['shapeFilter']);

        //cut type

        if(isset($filtersection['cutFilter']['cut_type_start']) && $filtersection['cutFilter']['cut_type_start'] !=null) {
            $record =$record->whereRaw("substr(cut_type_id,1,1) >= ".$filtersection['cutFilter']['cut_type_start']);
        }                           

        if(isset($filtersection['cutFilter']['cut_type_end']) && $filtersection['cutFilter']['cut_type_end'] !=null) {
            $record =$record->whereRaw("substr(cut_type_id,3,1) <= ".$filtersection['cutFilter']['cut_type_end']);
            //$record =$record->where('cut_type_id', '<=', $filtersection['cutFilter']['cut_type_end']);
        }

        //color filter colourless
        if(isset($filtersection['colorFilter']['colorless_id']) && $filtersection['colorFilter']['colorless_id']!=null){
            $allrecordId=self::select('id');

            $colorData=self::where('intensity_id',null)->select('id','color_id');
            
            if($param['record_type']=="pending"){
                $colorData=$colorData->where('status','Pending');
                $allrecordId=$allrecordId->where('status','Pending');
            }
            if($param['record_type']=="published"){
                $colorData=$colorData->where('status','Active');
                $allrecordId=$allrecordId->where('status','Active');
            }
            if($param['record_type']=="archived"){
                $colorData=$colorData->where('status','Archived');
                $allrecordId=$allrecordId->where('status','Archived');
            }else{
                $colorData=$colorData->where('status','!=','Archived');
                $allrecordId=$allrecordId->where('status','!=','Archived');
            }
            $allrecordId=$allrecordId->get()->toArray();
            $colorData=$colorData->get()->toArray();
            $allrecordId=array_column($allrecordId, 'id');
            
            foreach ($colorData as $key => $color) {
                $array=unserialize($color['color_id']);
                $colorids[$color['id']]=$array['color_id'];
            }
            
            foreach ($colorids as $key => $value) {
                $data=explode(',', $value);
                if(in_array($filtersection['colorFilter']['colorless_id'],$data)){
                   $colorless[]=$key;
                }
            }
            
            if(!isset($colorless))
            {
                $record=$record->whereNotIn('id',$allrecordId);
            }
        }

        //color filter fancy color
        if(isset($filtersection['colorFilter']['fancycolor_id']) && $filtersection['colorFilter']['fancycolor_id']!=null){
            $allrecordId=self::select('id');

            $colorData=self::where('intensity_id','!=',null)->select('id','color_id');
            if($param['record_type']=="pending"){
                $colorData=$colorData->where('status','Pending');
                $allrecordId=$allrecordId->where('status','Pending');
            }
            if($param['record_type']=="published"){
                $colorData=$colorData->where('status','Active');
                $allrecordId=$allrecordId->where('status','Active');
            }
            if($param['record_type']=="archived"){
                $colorData=$colorData->where('status','Archived');
                $allrecordId=$allrecordId->where('status','Archived');
            }else{
                $colorData=$colorData->where('status','!=','Archived');
                $allrecordId=$allrecordId->where('status','!=','Archived');
            }
            $colorData=$colorData->get()->toArray();
            $allrecordId=$allrecordId->get()->toArray();
            $allrecordId=array_column($allrecordId, 'id');
            //dd($colorData);
            foreach ($colorData as $key => $color) {
                
                $array=unserialize($color['color_id']);
                if(in_array($filtersection['colorFilter']['fancycolor_id'],$array)){
                   $search[]= $colorData[$key]['id'];
                }
            }

            if(!isset($search)){
                $record=$record->whereNotIn('id',$allrecordId);
                //$record=$record->whereIn('id',$search);
            }
        }

        if(isset($colorless) && isset($search)){

            $merge=array_merge($colorless,$search);
            $record=$record->whereIn('id',$merge);
        }else if(isset($colorless) && !isset($search)){

            $record=$record->whereIn('id',$colorless);
        }else if(isset($search) && !isset($colorless)){

            $record=$record->whereIn('id',$search);
        }
        
        //carat filter

        if(isset($filtersection['caratFilter']['carat_min']) && $filtersection['caratFilter']['carat_min'] !=null) {
            $record =$record->where('carat_min', '>=', $filtersection['caratFilter']['carat_min']);
        }

        if(isset($filtersection['caratFilter']['carat_max']) && $filtersection['caratFilter']['carat_max'] !=null) {

            $record =$record->where('carat_max', '<=', $filtersection['caratFilter']['carat_max']);
        }

        //clarity filter

        if(isset($filtersection['clarityFilter']['clarity_type_start']) && $filtersection['clarityFilter']['clarity_type_start'] !=null) {
            $record =$record->whereRaw("substr(clarity_type_id,1,1) >= ".$filtersection['clarityFilter']['clarity_type_start']);
            /*$record =$record->where('clarity_type_id', '>=', $filtersection['clarityFilter']['clarity_type_start']);*/
        }

        if(isset($filtersection['clarityFilter']['clarity_type_end']) && $filtersection['clarityFilter']['clarity_type_end'] !=null) {
            $record =$record->whereRaw("substr(clarity_type_id,3,1) <= ".$filtersection['clarityFilter']['clarity_type_end']);
        }

        //Fluorescence filter

        if(isset($filtersection['FluorescenceFilter']['florescence_type_start']) && $filtersection['FluorescenceFilter']['florescence_type_start'] !=null) {
            $record =$record->whereRaw("substr(florescence_type_id,1,1) >= ".$filtersection['FluorescenceFilter']['florescence_type_start']);
            /*$record =$record->where('florescence_type_id', '>=', $filtersection['FluorescenceFilter']['florescence_type_start']);*/
        }

        if(isset($filtersection['FluorescenceFilter']['florescence_type_end']) && $filtersection['FluorescenceFilter']['florescence_type_end'] !=null) {
            $record =$record->whereRaw("substr(florescence_type_id,3,1) <= ".$filtersection['FluorescenceFilter']['florescence_type_end']);
        }

        // price filter

        if(isset($filtersection['priceFilter']['min_price']) && $filtersection['priceFilter']['min_price'] !=null) {
            $record =$record->where('price', '>=', $filtersection['priceFilter']['min_price']);
        }

        if(isset($filtersection['priceFilter']['max_price']) && $filtersection['priceFilter']['max_price'] !=null) {
            $record =$record->where('price', '<=', $filtersection['priceFilter']['max_price']);
        }

        //totalprice filter

        if(isset($filtersection['totalPriceFilter']['total_min_price']) && $filtersection['totalPriceFilter']['total_min_price'] !=null) {
            $record =$record->where('totalprice', '>=', $filtersection['totalPriceFilter']['total_min_price']);
        }

        if(isset($filtersection['totalPriceFilter']['total_max_price']) && $filtersection['totalPriceFilter']['total_max_price'] !=null) {
            $record =$record->where('totalprice', '<=', $filtersection['totalPriceFilter']['total_max_price']);
        }

        //request_id Filter
        if(isset($filtersection['requestidFilter']['request_id']) && $filtersection['requestidFilter']['request_id'] !=null) {
            $record =$record->where('id', '=', $filtersection['requestidFilter']['request_id']);
        }

        //dropdown section
        if(isset($param['dropdownsection'])) {
            $dropdownsection = $param['dropdownsection'];

            //country_id
            if (isset($dropdownsection['dropdownFilter']['country_id']) && $dropdownsection['dropdownFilter']['country_id'] != null) {
                $country=$dropdownsection['dropdownFilter']['country_id'];
                $record=$record->Where(function ($query) use($country) {
                    for ($i = 0; $i < count($country); $i++){
                        $query->Orwhere('origin', 'like', '%'. $country[$i] .'%');
                    }
                });
            }

            //producer_id
            if (isset($dropdownsection['dropdownFilter']['producer_id']) && $dropdownsection['dropdownFilter']['producer_id'] != null) {

                $producer=$dropdownsection['dropdownFilter']['producer_id'];
                $record=$record->Where(function ($query) use($producer) {
                    for ($i = 0; $i < count($producer); $i++){
                        $query->Orwhere('origin', 'like', '%' . $producer[$i] .'%');
                    }
                });
                //$record = $record->whereIn('origin', 'LIKE', '____' . $dropdownsection['dropdownFilter']['producer_id'] . '%');
            }

            //mine_id_id
            if (isset($dropdownsection['dropdownFilter']['mine_id']) && $dropdownsection['dropdownFilter']['mine_id'] != null) {

                $mine=$dropdownsection['dropdownFilter']['mine_id'];
                $record=$record->Where(function ($query) use($mine) {
                    for ($i = 0; $i < count($mine); $i++){
                        $query->Orwhere('origin', 'like', '%' . $mine[$i] .'%');
                    }
                });
                //$record = $record->whereIn('origin', 'LIKE', '________' . $dropdownsection['dropdownFilter']['mine_id'] . '%');
            }
        }

        //datesection
        $datesection=$param['datesection'];
        if(isset($datesection['dateFilter']['start_date']) && $datesection['dateFilter']['start_date'] !=null) {
            $date = date('Y-m-d', strtotime($datesection['dateFilter']['start_date']));
            $record =$record->where(\DB::raw('DATE(created_at)'), '>=',$date);
        }

        if(isset($datesection['dateFilter']['end_date']) && $datesection['dateFilter']['end_date'] !=null) {
            $date = date('Y-m-d', strtotime($datesection['dateFilter']['end_date']));
            $record =$record->where(\DB::raw('DATE(created_at)'), '<=',$date);
        }
        //dd($record=$record->toSql());
        $record =$record->get()->toArray();

        //dd($record);
        $dataArr=array();

        foreach ($record as $key=>$rec){

            if ($rec['intensity_id'] == null) {
                $colorArr = unserialize($rec['color_id']);

                $getcoor = General::getLabel('colors',$colorArr['color_id']); /*\DB::table('colors')->whereIn('id', explode(',',$colorArr['color_id']))->select('id', 'label')->get()->toArray();*/

                $dataArr[$key]['color_id'] = $colorArr['color_id'];
                $dataArr[$key]['color_label'] = $getcoor;

            } else {

                $intensity = \DB::table('intensity')->whereIn('id', explode('.',$rec['intensity_id']))->select('name as intensity_label')->get();
                
                $colorArr = unserialize($rec['color_id']);
                $colorArr = array($colorArr['color_id_1'], $colorArr['color_id_2'], $colorArr['color_id_3']);
                $getcoor = \DB::table('colors')->whereIn('id', $colorArr)->select('label')->get()->toArray();

                $getcoor = array_column($getcoor, 'label');
                $dataArr[$key]['fancy_color_gp'] = $colorArr;
                $dataArr[$key]['color_label'] = $intensity[0]->intensity_label . '-' . implode(',', $getcoor);
                // dd($record);
            }
            
            $dataArr[$key]['id']=$rec['id'];
            $dataArr[$key]['user_id']=$rec['user_id'];
            $dataArr[$key]['carat']=$rec['carat_min']."-".$rec['carat_max'];
            $dataArr[$key]['created_at']=date('d-m-Y',strtotime($rec['created_at']));
            $dataArr[$key]['origin']=$rec['origin'];
            $dataArr[$key]['clarity_type_label']=General::getLabel('clarity_types',$rec['clarity_type_id']);
            $dataArr[$key]['cut_type_label']=General::getLabel('cut_types',$rec['cut_type_id']);
            $dataArr[$key]['florescence_type_label']=General::getLabel('florescence_types',$rec['florescence_type_id']);

            $dataArr[$key]['certification_laboratory_label']=General::getLabel('certification_laboratories',$rec['certification_laboratory_id']);
            $dataArr[$key]['brand_label']=General::getLabel('brands',$rec['brand_id']);
            $dataArr[$key]['shape_label']=General::getLabel('shapes',$rec['shape_id']);
            $dataArr[$key]['radio-button']='';
        }
        
        return $dataArr;
    }

    public static function ArchiveRecord($param)
    {
        return self::whereIn('id',$param)->update(array('status'=>'Archived'));
    }

    public static function DeleteRecord($param){

        return self::whereIn('id',$param)->delete();
    }
    
}
