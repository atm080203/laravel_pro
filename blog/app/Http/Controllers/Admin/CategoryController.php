<?php

namespace App\Http\Controllers\Admin;
use App\Http\Model\Category;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;

class CategoryController extends CommonController
{
    //get
    public function index(){
      // $category = Category::all();
      // $data = $this->getTree($category, 'cate_name', 'cate_id', 'cate_pid', 0);
      $data = Category::tree();
      // dd($data);
      return view('admin.category.index')->with('data', $data);
    }



    //post
    public function store(){

    }
    //get
    public function create(){

    }
    //get
    public function show(){

    }
    //get
    public function destory(){

    }
    //put patch
    public function update(){

    }
    //get
    public function edit(){

    }

    public function changeorder(){
        $input = Input::all();
        // echo $input['cate_id'];
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->update();
        // echo $re;
        if($re){
            $data = [
                'status' => 0,
                'msg' => '分类排序更新成功！'
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '分类排序更新失败！'
            ];
        }
        return $data;
    }

}
