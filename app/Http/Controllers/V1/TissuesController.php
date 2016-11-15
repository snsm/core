<?php

namespace App\Http\Controllers\V1;
use App\Http\Controllers\ApiController;
use App\Tissue;
use Illuminate\Http\Request;
use App\Transformer\UserTransformer;


class TissuesController extends ApiController
{
    //组织列表
    public function Index()
    {
        return 'ok';
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
}