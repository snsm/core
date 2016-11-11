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
            'tissue_class' => 'required',
            'tissue_user_id' => 'required',
        ]);

        //2、判断验证是否正确
        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError('创建失败！');
        }

        //3、接受参数并且保存数据
       $tissue =  Tissue::create([
            'tissue_name' => $request->get('tissue_name'),
            'tissue_coding' => $request->get('tissue_coding'),
            'tissue_type' => $request->get('tissue_type'),
            'tissue_class' => $request->get('tissue_class'),
            'tissue_user_id' => $request->get('tissue_user_id'),
        ]);

        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'massage' => '创建成功！',
            'data' => $tissue->toArray()
        ]);
    }
}