<?php

namespace App\Http\Controllers\V1;
use App\Http\Controllers\ApiController;
use App\Tissue;
use Illuminate\Http\Request;


class TissuesController extends ApiController
{
    ////显示所有组织列表
    public function Index()
    {
        $tissue = Tissue::all();
        return $this->response([
            'status' => 'success',
            'data' => $tissue->toArray()
        ]);
    }

    //创建组织
    public function Create(Request $request)
    {
        //1、验证
        $validator = \Validator::make($request->input(), [
            'tissue_name' => 'required',
            'tissue_coding' => 'required|unique:tissues',
            'tissue_type' => 'required',
            'parent_id' => 'required',
            'tissue_order' => 'required',
        ]);

        //2、判断验证是否正确
        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError($validator->messages());
        }

        //3、接受参数并且保存数据
       $tissue =  Tissue::create($request->all());

        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'data' => $tissue->toArray()
        ]);
    }

    //更新组织列表
    public function Update(Request $request)
    {
        //1、验证
        $validator = \Validator::make($request->input(), [
            'id' => 'required',
            'tissue_name' => 'required',
            'tissue_type' => 'required',
            'parent_id' => 'required',
            'tissue_order' => 'required',
        ]);

        //2、判断验证是否正确
        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError($validator->messages());
        }

        $tissue = Tissue::find($request->input('id'));
        if(!$tissue){
            return $this->responseNotFount();
        }
        $tissue->tissue_name = $request->input('tissue_name');
        $tissue->tissue_type = $request->input('tissue_type');
        $tissue->parent_id = $request->input('parent_id');
        $tissue->tissue_order = $request->input('tissue_order');
        $tissue->save();
        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'data' => $tissue->toArray()
        ]);
    }

    //删除组织列表
    public function Delete(Request $request)
    {
        if(!$tissue = Tissue::find($request->input('id'))){
            return $this->responseNotFount();
        }
        $tissue->delete();
        return $this->setStatusCode(200)->response([
            'status' => 'success',
            'massage' => '删除成功！'
        ]);
    }

}