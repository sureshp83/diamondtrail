<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diamonds extends Model
{
    protected $table = "diamonds";
    protected $fillable = ['user_id', 'gridle_type_id', 'culet_type_id', 'polish_type_id', 'symmetry_type_id', 'clarity_type_id', 'color_id', 'intensity_id', 'cut_type_id',
        'shape_id', 'florescence_type_id', 'certification_laboratory_id', 'certification_number', 'origin', 'brand_id', 'carat', 'price', 'totalprice', 'depth', 'status', 'diamond_certi_file',
        'deleted_at', 'created_at', 'updated_at', 'width', 'length', 'depth_percent', 'table_percent'];
    protected $hidden = [];


    public function ScopeActive($query)
    {
        return $query->where('status', 'Active');
    }
    public function ScopeNotUncomplate($query){
        return $query->where('status','!=','Uncomplete');
    }

    public static function postCount($user_id){
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

    public static function getDiamond($id,$auth=false)
    {   if($auth)
        $whereArr=array('diamonds.id'=>$id);
        else
        $whereArr=array('diamonds.id'=>$id,'user_id'=>\Auth::user()->id);

        $record = self::NotUncomplate()->where($whereArr)
            ->join('clarity_types', 'clarity_types.id', '=', 'clarity_type_id')
            ->join('cut_types', 'cut_types.id', '=', 'cut_type_id')
            ->join('shapes', 'shapes.id', '=', 'shape_id')
            ->join('florescence_types', 'florescence_types.id', '=', 'florescence_type_id')
            ->join('certification_laboratories', 'certification_laboratories.id', '=', 'certification_laboratory_id')
            ->join('brands', 'brands.id', '=', 'brand_id')
            ->select('diamonds.*','clarity_types.label as clarity_type_label','cut_types.label as cut_type_label','shapes.label as shape_label','florescence_types.label as florescence_type_label','certification_laboratories.label as certification_laboratory_label','brands.label as brand_label')
            ->get()->toArray();
        if(isset($record[0])) {

            if ($record[0]['intensity_id'] == null) {
                $colorArr = unserialize($record[0]['color_id']);
                $getcoor = \DB::table('colors')->where('id', $colorArr['color_id'])->select('id', 'label')->get();
                $record[0]['color_id'] = $getcoor[0]->id;
                $record[0]['color_label'] = $getcoor[0]->label;

            } else {
                $intensity = \DB::table('intensity')->where('id', $record[0]['intensity_id'])->select('name as intensity_label')->get();
                $colorArr = unserialize($record[0]['color_id']);
                $colorArr = array($colorArr['color_id_1'], $colorArr['color_id_2'], $colorArr['color_id_3']);
                $getcoor = \DB::table('colors')->whereIn('id', $colorArr)->select('label')->get()->toArray();
                $getcoor = array_column($getcoor, 'label');
                $record[0]['fancy_color_gp'] = $colorArr;
                $record[0]['color_label'] = $intensity[0]->intensity_label . '-' . implode(',', $getcoor);
                //dd($record);
            }
        }
        return $record;
    }

    public static function StoreImages($param,$id){
        foreach ($param as $key => $val){
            $record=\DB::table('diamond_images')->insert(array('diamond_id'=>$id,'name'=>$val));
        }
        return $record;
    }

    public static function getDiamondImg($id){
        return \DB::table('diamond_images')->where('diamond_id',$id)->get()->toArray();

    }

    public static function post_diamond($id){
        $record=self::where('id',$id)->update(array('status'=>'Active'));
        return $record;
    }

    public static function getActivePost($id=""){
        $record=self::Active();
        if($id)
            $record =$record->where('user_id',$id);

        $record =$record->join('clarity_types', 'clarity_types.id', '=', 'clarity_type_id')
            ->join('cut_types', 'cut_types.id', '=', 'cut_type_id')
            ->join('shapes', 'shapes.id', '=', 'shape_id')
            ->join('florescence_types', 'florescence_types.id', '=', 'florescence_type_id')
            ->join('certification_laboratories', 'certification_laboratories.id', '=', 'certification_laboratory_id')
            ->join('brands', 'brands.id', '=', 'brand_id')
            ->select('diamonds.*','clarity_types.label as clarity_type_label','cut_types.label as cut_type_label','shapes.label as shape_label','florescence_types.label as florescence_type_label','certification_laboratories.label as certification_laboratory_label','brands.label as brand_label')->orderBy('id','desc')
            ->get()->toArray();
        $dataArray=array();
        foreach ($record as $key => $rec){
            $dataArray[$key]['created_at']=date('d-m-Y',strtotime($rec['created_at']));
            $dataArray[$key]['id']=$rec['id'];
            $dataArray[$key]['origin']=$rec['origin'];
            $dataArray[$key]['shape_label']=$rec['shape_label'];
            $dataArray[$key]['clarity_type_label']=$rec['clarity_type_label'];
            $dataArray[$key]['carat']=$rec['carat'];
            $dataArray[$key]['intensity_id']=$rec['intensity_id'];
            $dataArray[$key]['cut_type_label']=$rec['cut_type_label'];
            $dataArray[$key]['florescence_type_label']=$rec['florescence_type_label'];
                if ($rec['intensity_id'] == null) {
                    $colorArr = unserialize($rec['color_id']);
                    $getcoor = \DB::table('colors')->where('id', $colorArr['color_id'])->select('id', 'label')->get();
                    $dataArray[$key]['color_id'] = $getcoor[0]->id;
                    $dataArray[$key]['color_label'] = $getcoor[0]->label;

                } else {
                    $intensity = \DB::table('intensity')->where('id', $rec['intensity_id'])->select('name as intensity_label')->get();
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

    public static function deleteDiamondImg($id){

        $record=\DB::table('diamond_images')->where('id',$id);
        $imgname=$record->select('name')->first();

        unlink(base_path().'/public/uploads/diamond_img/'.$imgname->name);
        $record=$record->delete();
        return $record;
    }

   public static function getPosts($param=""){
        $record=self::NotUncomplate()->where('user_id',\Auth::user()->id);

        if($param=="pending"){
            $record=$record->where('status','Pending');
        }
        if($param=="published"){
            $record=$record->where('status','Active');
        }
        if($param=="archived"){
            $record=$record->where('status','Archived');
        }

            $record=$record->get()->toArray();

        foreach ($record as $key=>$rec){

            if ($rec['intensity_id'] == null) {
                $colorArr = unserialize($rec['color_id']);
                $getcoor = \DB::table('colors')->where('id', $colorArr['color_id'])->select('id', 'label')->get();
                $record[$key]['color_id'] = $getcoor[0]->id;
                $record[$key]['color_label'] = $getcoor[0]->label;

            } else {
                $intensity = \DB::table('intensity')->where('id', $rec['intensity_id'])->select('name as intensity_label')->get();
                $colorArr = unserialize($rec['color_id']);
                $colorArr = array(isset($colorArr['color_id_1'])?$colorArr['color_id_1']:0, isset($colorArr['color_id_2'])?$colorArr['color_id_2']:0, isset($colorArr['color_id_3'])?$colorArr['color_id_3']:0);

                $getcoor = \DB::table('colors')->whereIn('id', $colorArr)->select('label')->get()->toArray();
                $getcoor = array_column($getcoor, 'label');
                $record[$key]['fancy_color_gp'] = $colorArr;
                $record[$key]['color_label'] = $intensity[0]->intensity_label . '-' . implode(',', $getcoor);
                //dd($record);
            }

            $record[$key]['shape_label']=General::getLabel('shapes',$rec['shape_id']);
            $record[$key]['clarity_type_label']=General::getLabel('clarity_types',$rec['clarity_type_id']);
            $record[$key]['cut_type_label']=General::getLabel('cut_types',$rec['cut_type_id']);
            $record[$key]['florescence_type_label']=General::getLabel('florescence_types',$rec['florescence_type_id']);
            $record[$key]['radio-button']='<input class="form-control radio-input" id="'.$rec['id'].'" name="selectedrecord[]" type="checkbox"><label class="radio-btn" for="'.$rec['id'].'">&nbsp;</label>';
        }
        return $record;
    }
    //my post
    public static function getPostByAjaxCall($param){
        if(isset($param['user_id']))
        $record=self::NotUncomplate()->where('user_id',$param['user_id']);
        else
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
        if($param['record_type']=="all"){
            $record=$record->where('status','!=','Archived');
        }
        

        if(isset($param['filtersection'])){
        $filtersection=$param['filtersection'];

        //shape filter

        if(isset($filtersection['shapeFilter']) && $filtersection['shapeFilter']!=null)
            $record=$record->whereIn('shape_id',$filtersection['shapeFilter']);

        //cut type

        if(isset($filtersection['cutFilter']['cut_type_start']) && $filtersection['cutFilter']['cut_type_start'] !=null) {
            $record =$record->where('cut_type_id', '>=', $filtersection['cutFilter']['cut_type_start']);
        }

        if(isset($filtersection['cutFilter']['cut_type_end']) && $filtersection['cutFilter']['cut_type_end'] !=null) {

            $record =$record->where('cut_type_id', '<=', $filtersection['cutFilter']['cut_type_end']);
        }

        //carat filter

        if(isset($filtersection['caratFilter']['carat_min']) && $filtersection['caratFilter']['carat_min'] !=null) {
            $record =$record->where('carat', '>=', $filtersection['caratFilter']['carat_min']);
        }

        if(isset($filtersection['caratFilter']['carat_max']) && $filtersection['caratFilter']['carat_max'] !=null) {

            $record =$record->where('carat', '<=', $filtersection['caratFilter']['carat_max']);
        }

        //clarity filter

        if(isset($filtersection['clarityFilter']['clarity_type_start']) && $filtersection['clarityFilter']['clarity_type_start'] !=null) {
            $record =$record->where('clarity_type_id', '>=', $filtersection['clarityFilter']['clarity_type_start']);
        }

        if(isset($filtersection['clarityFilter']['clarity_type_end']) && $filtersection['clarityFilter']['clarity_type_end'] !=null) {
            $record =$record->where('clarity_type_id', '<=', $filtersection['clarityFilter']['clarity_type_end']);
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
            $colorData=$colorData->get()->toArray();
            $allrecordId=$allrecordId->get()->toArray();
            $allrecordId=array_column($allrecordId, 'id');
            
            foreach ($colorData as $key => $color) {
                $array=unserialize($color['color_id']);
                $colorids[$color['id']]=$array['color_id'];
            }

            if(isset($colorids)){
            if($keys=array_keys($colorids,$filtersection['colorFilter']['colorless_id'])){
                $colorless[]=$keys;
                //$record=$record->whereIn('id',$keys);
            }
            else{
                $record=$record->whereNotIn('id',$allrecordId);
            }
          }else{
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

            $merge=array_merge($colorless[0],$search);
            $record=$record->whereIn('id',$merge);
        }else if(isset($colorless) && !isset($search)){

            $record=$record->whereIn('id',$colorless[0]);
        }else if(isset($search) && !isset($colorless)){

            $record=$record->whereIn('id',$search);
        }

        //Fluorescence filter

        if(isset($filtersection['FluorescenceFilter']['florescence_type_start']) && $filtersection['FluorescenceFilter']['florescence_type_start'] !=null) {
            $record =$record->where('florescence_type_id', '>=', $filtersection['FluorescenceFilter']['florescence_type_start']);
        }

        if(isset($filtersection['FluorescenceFilter']['florescence_type_end']) && $filtersection['FluorescenceFilter']['florescence_type_end'] !=null) {
            $record =$record->where('florescence_type_id', '<=', $filtersection['FluorescenceFilter']['florescence_type_end']);
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

    }
        if(isset($param['dropdownsection'])){
        //dropdown section
        $dropdownsection=$param['dropdownsection'];

        //country_id
        if(isset($dropdownsection['dropdownFilter']['country_id']) && $dropdownsection['dropdownFilter']['country_id'] !=null) {
            $record =$record->where('origin', 'LIKE', $dropdownsection['dropdownFilter']['country_id'].'%');
        }

        //producer_id
        if(isset($dropdownsection['dropdownFilter']['producer_id']) && $dropdownsection['dropdownFilter']['producer_id'] !=null) {
            
            $record =$record->where('origin', 'LIKE', '%-'.$dropdownsection['dropdownFilter']['producer_id'].'%');
        }

        //mine_id_id
        if(isset($dropdownsection['dropdownFilter']['mine_id']) && $dropdownsection['dropdownFilter']['mine_id'] !=null) {
            
            $record =$record->where('origin', 'LIKE','%-%-'. $dropdownsection['dropdownFilter']['mine_id'].'%');
        }
    }
        if(isset($param['datesection'])){
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
        }
        
        //dd($record->toSql());
        $record=$record->get()->toArray();

        if(!empty($record)) {
            foreach ($record as $key => $rec) {

                if ($rec['intensity_id'] == null) {
                    $colorArr = unserialize($rec['color_id']);
                    $getcoor = \DB::table('colors')->where('id', $colorArr['color_id'])->select('id', 'label')->get();
                    $record[$key]['color_id'] = $getcoor[0]->id;
                    $record[$key]['color_label'] = $getcoor[0]->label;

                } else {
                    $intensity = \DB::table('intensity')->where('id', $rec['intensity_id'])->select('name as intensity_label')->get();
                    $colorArr = unserialize($rec['color_id']);
                    $colorArr = array($colorArr['color_id_1'], $colorArr['color_id_2'], $colorArr['color_id_3']);
                    $getcoor = \DB::table('colors')->whereIn('id', $colorArr)->select('label')->get()->toArray();
                    $getcoor = array_column($getcoor, 'label');
                    $record[$key]['fancy_color_gp'] = $colorArr;
                    $record[$key]['color_label'] = $intensity[0]->intensity_label . '-' . implode(',', $getcoor);
                    //dd($record);
                }
                $record[$key]['created_at']=date('d-m-Y',strtotime($rec['created_at']));
                $record[$key]['shape_label'] = General::getLabel('shapes', $rec['shape_id']);
                $record[$key]['clarity_type_label'] = General::getLabel('clarity_types', $rec['clarity_type_id']);
                $record[$key]['cut_type_label'] = General::getLabel('cut_types', $rec['cut_type_id']);
                $record[$key]['florescence_type_label'] = General::getLabel('florescence_types', $rec['florescence_type_id']);
                /*$record[$key]['radio-button']='<input class="form-control radio-input" name="selectedrecord[]" id="'.$rec['id'].'" type="checkbox"><label class="radio-btn" for="'.$rec['id'].'">&nbsp;</label>';*/
                $record[$key]['radio-button']='';
            }
        }else{
            $record=array(
                'radio-button'=>null,
                'created_at'=>null,
                'id'=>null,
                'origin'=>null,
                'origin'=>null,
                'shape_label'=>null,
                'carat'=>null,
                'clarity_type_label'=>null,
                'color_label'=>null,
                'cut_type_label'=>null,
                'florescence_type_label'=>null,
                'price'=>null,
                'totalprice'=>null
            );
            $record['recordcount']=0;
        }

        return $record;

    }
    public static function getFullDetail($param){

        $data=self::NotUncomplate()->whereIn('id',$param)->get()->toArray();
        $dataArr=array();


        foreach ($data as $key => $row){
            $origin=explode('-',$row['origin']);

            $dataArr['created_at'][$key]=date('d-m-Y',strtotime($row['created_at']));
            $dataArr['id'][$key]=$row['id'];
            $dataArr['price'][$key]=$row['price'];
            $dataArr['totalprice'][$key]=$row['totalprice'];
            $dataArr['origin'][$key]=$row['origin'];
            $dataArr['country_id'][$key]=$origin[0];
            $dataArr['producer_id'][$key]=$origin[1];
            $dataArr['mine_id'][$key]=$origin[2];
            $dataArr['shape_label'][$key]=General::getLabel('shapes',$row['shape_id']);
            $dataArr['carat'][$key]=$row['carat'];
            $dataArr['clarity_label'][$key]=General::getLabel('clarity_types',$row['clarity_type_id']);
            $dataArr['cut_label'][$key]=General::getLabel('cut_types',$row['cut_type_id']);
            $dataArr['florescence_type_label'][$key]=General::getLabel('florescence_types',$row['florescence_type_id']);
            $dataArr['brand_label'][$key]=General::getLabel('brands',$row['brand_id']);
            $dataArr['certification_laboratory_label'][$key]=General::getLabel('certification_laboratories',$row['certification_laboratory_id']);
            $dataArr['certification_number'][$key]=$row['certification_number'];
            $dataArr['user_name']=\App\User::getUserNameByDId($row['user_id']);
            $dataArr['user_email']=\App\User::getUserEmailByDId($row['user_id']);
            $dataArr['comp_name']=\App\Profiles::getCompNameByDId($row['user_id']);
            $dataArr['comp_telno']=\App\Profiles::getCompTelNoByDId($row['user_id']);
            $dataArr['status']=$row['status'];
            if ($row['intensity_id'] == null) {
                $colorArr = unserialize($row['color_id']);
                $getcoor = \DB::table('colors')->where('id', $colorArr['color_id'])->select('id', 'label')->get();
                $dataArr['color_id'][$key] = $getcoor[0]->id;
                $dataArr['color_label'][$key] = $getcoor[0]->label;

            } else {
                $intensity = \DB::table('intensity')->where('id', $row['intensity_id'])->select('name as intensity_label')->get();
                $colorArr = unserialize($row['color_id']);
                $colorArr = array($colorArr['color_id_1'], $colorArr['color_id_2'], $colorArr['color_id_3']);
                $getcoor = \DB::table('colors')->whereIn('id', $colorArr)->select('label')->get()->toArray();
                $getcoor = array_column($getcoor, 'label');
                $dataArr['fancy_color_gp'][$key] = $colorArr;
                $dataArr['color_label'][$key] = $intensity[0]->intensity_label . '-' . implode(',', $getcoor);
                //dd($record);
            }
            $dataArr['diamond_image'][$key]=General::getFirstImage($row['id']);
            $dataArr['diamond_all_image'][$key]=General::getImage($row['id']);
        }
        return $dataArr;
    }

    //search diamond
    public static function getAjaxSearchDiamond($param){
        $record=self::Active();

        if($param['record_type']=="pending"){
            $record=$record->where('status','Pending');
        }
        if($param['record_type']=="published"){
            $record=$record->where('status','Active');
        }
        if($param['record_type']=="archived"){
            $record=$record->where('status','Archived');
        }

        $filtersection=$param['filtersection'];

        //shape filter

        if(isset($filtersection['shapeFilter']) && $filtersection['shapeFilter']!=null)
            $record=$record->whereIn('shape_id',$filtersection['shapeFilter']);

        //cut type

        if(isset($filtersection['cutFilter']['cut_type_start']) && $filtersection['cutFilter']['cut_type_start'] !=null) {
            $record =$record->where('cut_type_id', '>=', $filtersection['cutFilter']['cut_type_start']);
        }

        if(isset($filtersection['cutFilter']['cut_type_end']) && $filtersection['cutFilter']['cut_type_end'] !=null) {

            $record =$record->where('cut_type_id', '<=', $filtersection['cutFilter']['cut_type_end']);
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

            if($keys=array_keys($colorids,$filtersection['colorFilter']['colorless_id'])){
                $colorless[]=$keys;
                //$record=$record->whereIn('id',$keys);
            }
            else{
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

            $merge=array_merge($colorless[0],$search);
            $record=$record->whereIn('id',$merge);
        }else if(isset($colorless) && !isset($search)){

            $record=$record->whereIn('id',$colorless[0]);
        }else if(isset($search) && !isset($colorless)){

            $record=$record->whereIn('id',$search);
        }
        

        //carat filter

        if(isset($filtersection['caratFilter']['carat_min']) && $filtersection['caratFilter']['carat_min'] !=null) {
            $record =$record->where('carat', '>=', $filtersection['caratFilter']['carat_min']);
        }

        if(isset($filtersection['caratFilter']['carat_max']) && $filtersection['caratFilter']['carat_max'] !=null) {

            $record =$record->where('carat', '<=', $filtersection['caratFilter']['carat_max']);
        }

        //clarity filter

        if(isset($filtersection['clarityFilter']['clarity_type_start']) && $filtersection['clarityFilter']['clarity_type_start'] !=null) {
            $record =$record->where('clarity_type_id', '>=', $filtersection['clarityFilter']['clarity_type_start']);
        }

        if(isset($filtersection['clarityFilter']['clarity_type_end']) && $filtersection['clarityFilter']['clarity_type_end'] !=null) {
            $record =$record->where('clarity_type_id', '<=', $filtersection['clarityFilter']['clarity_type_end']);
        }

        //Fluorescence filter

        if(isset($filtersection['FluorescenceFilter']['florescence_type_start']) && $filtersection['FluorescenceFilter']['florescence_type_start'] !=null) {
            $record =$record->where('florescence_type_id', '>=', $filtersection['FluorescenceFilter']['florescence_type_start']);
        }

        if(isset($filtersection['FluorescenceFilter']['florescence_type_end']) && $filtersection['FluorescenceFilter']['florescence_type_end'] !=null) {
            $record =$record->where('florescence_type_id', '<=', $filtersection['FluorescenceFilter']['florescence_type_end']);
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
                        $query->Orwhere('origin', 'like', '%'.$country[$i] .'%');
                    }
                });
                //$record = $record->whereIn('origin', 'LIKE', $dropdownsection['dropdownFilter']['country_id'] . '%');
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
       if(isset($param['datesection'])){
        $datesection=$param['datesection'];
        if(isset($datesection['dateFilter']['start_date']) && $datesection['dateFilter']['start_date'] !=null) {
            $date = date('Y-m-d', strtotime($datesection['dateFilter']['start_date']));
            $record =$record->where(\DB::raw('DATE(created_at)'), '>=',$date);
        }

        if(isset($datesection['dateFilter']['end_date']) && $datesection['dateFilter']['end_date'] !=null) {
            $date = date('Y-m-d', strtotime($datesection['dateFilter']['end_date']));
            $record =$record->where(\DB::raw('DATE(created_at)'), '<=',$date);
        }
       } 
        //dd($record->toSql());
        $record=$record->get()->toArray();

        //if(!empty($record)) {
            $dataArr=array();
            foreach ($record as $key => $rec) {

                if ($rec['intensity_id'] == null) {
                    $colorArr = unserialize($rec['color_id']);
                    $getcoor = \DB::table('colors')->where('id', $colorArr['color_id'])->select('id', 'label')->get();
                    $dataArr[$key]['color_id'] = $getcoor[0]->id;
                    $dataArr[$key]['color_label'] = $getcoor[0]->label;

                } else {
                    $intensity = \DB::table('intensity')->where('id', $rec['intensity_id'])->select('name as intensity_label')->get();
                    $colorArr = unserialize($rec['color_id']);
                    $colorArr = array($colorArr['color_id_1'], $colorArr['color_id_2'], $colorArr['color_id_3']);
                    $getcoor = \DB::table('colors')->whereIn('id', $colorArr)->select('label')->get()->toArray();
                    $getcoor = array_column($getcoor, 'label');
                    $dataArr[$key]['fancy_color_gp'] = $colorArr;
                    $dataArr[$key]['color_label'] = $intensity[0]->intensity_label . '-' . implode(',', $getcoor);
                    //dd($record);
                }
                $dataArr[$key]['id']=$rec['id'];
                $dataArr[$key]['user_id']=$rec['user_id'];
                $dataArr[$key]['carat']=$rec['carat'];
                $dataArr[$key]['origin']=$rec['origin'];
                $dataArr[$key]['price']=$rec['price'];
                $dataArr[$key]['totalprice']=$rec['totalprice'];
                $dataArr[$key]['created_at']=date('d-m-Y',strtotime($rec['created_at']));
                $dataArr[$key]['shape_label'] = General::getLabel('shapes', $rec['shape_id']);
                $dataArr[$key]['clarity_type_label'] = General::getLabel('clarity_types', $rec['clarity_type_id']);
                $dataArr[$key]['cut_type_label'] = General::getLabel('cut_types', $rec['cut_type_id']);
                $dataArr[$key]['florescence_type_label'] = General::getLabel('florescence_types', $rec['florescence_type_id']);
                $dataArr[$key]['radio-button']='';

            }
        //}

        return $dataArr;

    }
    public static function ArchiveDiamond($param)
    {
        return self::whereIn('id',$param)->update(array('status'=>'Archived'));
    }

    public static function DeleteRecord($param){

        return self::whereIn('id',$param)->delete();
    }
}
