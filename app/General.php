<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    public static function CreateComp_type($param){
        $Record=\DB::table('company_type')->insertGetId(array('name'=>$param,'created_at'=>date('Y-m-d H:i:s')));
        return $Record;
    }
    public static function getLabel($table,$filedStr){
        $record=\DB::table($table)->whereIn('id',explode(',',$filedStr))->select(\DB::raw('group_concat(label SEPARATOR "-") as label'))->get()->toArray();
        return $record[0]->label;
    }

    public static function getFirstImage($id){
        $data=\DB::table('diamond_images')->where('diamond_id',$id)->select('name')->first();
        if(!isset($data->name)){
           return "default.png";
        }
        return $data->name;
    }

    public static function getImage($id){
        $data=\DB::table('diamond_images')->where('diamond_id',$id)->select('name')->get();
        return $data;
    }

    public static function getPagesContentByType($type){
        return \DB::table('site_content')->where('page_type',$type)->get()->toArray();

    }

    public static function InsertPagesContent($param){
        $data=\DB::table('site_content')->insertGetId($param);
        return $data;
    }

    public static function UpdatePagesContent($param){
        $content_id=$param['content_id'];
        unset($param['content_id']);
        return \DB::table('site_content')->where('id',$content_id)->update($param);
    }

    public static function InsertProducers($param){

        $images=$param['images'];
        unset($param['images']);
        if(isset($param['producer_id'])){
            unset($param['producer_id']);
        }
        $record=\DB::table('producers')->insertGetId($param);
        foreach ($images['image'] as $key => $value) {
            $array=array(
                'producer_id'=>$record,
                'image'=>$value
                );
            $imgRecord=\DB::table('producer_images')->insert($array);
        }
        return $record;
    }

    public static function UpdateProducers($param){
        if(isset($param['images'])){
            $images=$param['images'];
            unset($param['images']);    
        }
        $producer_id=$param['producer_id'];
        unset($param['producer_id']);
        $record=\DB::table('producers')->where('id',$producer_id)->update($param);
        if(isset($images)){
            foreach ($images['image'] as $key => $value) {
                $array=array(
                    'producer_id'=>$producer_id,
                    'image'=>$value
                    );
                $imgRecord=\DB::table('producer_images')->insert($array);
            }
        }
        return $record;
    }

    public static function getProducersContent(){
        $query = \DB::table('producers')->select('producers.id','producers.producer_name','producers.producer_content','producers.producer_file','producer_images.image')
                 ->leftJoin('producer_images', function($query) {
                    $query->on('producers.id','=','producer_images.producer_id')
                        ->whereRaw('producer_images.id IN (select MAX(a2.id) from producer_images as a2 join producers as u2 on u2.id = a2.producer_id group by u2.id)');
                })
                ->get()->toArray();

       return $query; 
    }

    public static function getSingleProducer($id){
        $data['producer']=\DB::table('producers')->where('producers.id',$id)->get()->toArray();
        $data['images']=\DB::table('producer_images')->where('producer_id',$id)->get()->toArray();
                    
        return $data;        
    }

    public static function getProducerImages($id){
        return \DB::table('producer_images')->where('producer_id',$id)->get()->toArray();
    }

    public static function getAllProducersContent(){
        $producer=\DB::table('producers')->get()->toArray();
        $array=array();
        foreach ($producer as $key => $value) {
            $array[$key]['producer_id']=$value->id;
            $array[$key]['images']=self::getProducerImages($value->id);
            $array[$key]['producer_name']=$value->producer_name;
            $array[$key]['producer_content']=$value->producer_content;
            $array[$key]['producer_file']=$value->producer_file;
        }

       return $array; 
    }

    public static function deleteProducerImg($imgid){
        $record=\DB::table('producer_images')->where('id',$imgid);
        $imgname=$record->select('image')->first();
        if($imgname->image !=null  && file_exists(base_path().'/public/producer/pages_img/'.$imgname->image)){
            unlink(base_path().'/public/producer/pages_img/'.$imgname->image);
        }
        $record=$record->delete();
        return $record;
    }

    public static function deleteProducerPdf($producerid){
        $record=\DB::table('producers')->where('id',$producerid);
        $pdfname=$record->select('producer_file')->first();

        if($pdfname->producer_file!=null && file_exists(base_path().'/public/producer/pdffile/'.$pdfname->producer_file)){
            unlink(base_path().'/public/producer/pdffile/'.$pdfname->producer_file);
        }
        $record=$record->update(array('producer_file'=>null));
        return $record;
    }

    public static function deleteProducer($id){
        $data=\DB::table('producers')->where('id',$id);
        $record=$data->first();
        self::deleteProducerPdf($record->id);
        $images=self::getProducerImages($record->id);        
        foreach ($images as $key => $value) {
            self::deleteProducerImg($value->id);
        }
        return $data->delete();
    }
}
