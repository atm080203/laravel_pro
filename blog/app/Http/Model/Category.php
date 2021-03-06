<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table='category';
    protected $primaryKey='cate_id';
    public $timestamps=false;

    public static function tree(){
      // $category = Category::all();
      $category = $this->orderBy('cate_order', 'asc')->get();
      return (new Category)->getTree($category, 'cate_name', 'cate_id', 'cate_pid', 0);
    }

    public function getTree($data, $field_name, $field_id='id', $field_pid='p_id', $p_id=0){
      // dd($data);
      $arr = array();
      foreach ($data as $k => $v) {
        # code...
        if($v->$field_pid == $p_id){
          // echo $v->cate_name;
          $data[$k]['_'.$field_name] = $data[$k][$field_name];
          $arr[] = $data[$k];
          foreach ($data as $m => $n) {
            # code...
            if($n->$field_pid == $v->$field_id){
              $data[$m]['_'.$field_name] = '|--'.$data[$m][$field_name];
              $arr[] = $data[$m];
            }
          }
        }
      }
      // dd($arr);
      return $arr;
    }
}
