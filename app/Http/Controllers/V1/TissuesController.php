<?php

namespace App\Http\Controllers\V1;
use App\Http\Controllers\ApiController;
use App\Tissue;
use App\TissueApply;
use Illuminate\Http\Request;
use App\Transformer\UserTransformer;


class TissuesController extends ApiController
{
    //组织列表
    public function Index()
    {
        return 'ok';
    }

    //创建公司名称
    public function createCompany(Request $request)
    {
        //1、验证
        $validator = \Validator::make($request->input(), [
            'tissue_company_name' => 'required',
            'tissue_company_coding' => 'required|unique:tissues',
        ]);

        //2、判断验证是否正确
        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError($validator->messages());
        }

        //3、接受参数并且保存数据
        $tissue =  Tissue::create($request->all());

        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'massage' => '创建成功！',
            'data' => $tissue->toArray()
        ]);
    }

    //创建组织列表
    public function Create(Request $request)
    {
        //1、验证
        $validator = \Validator::make($request->input(), [
            'tissue_name' => 'required',
            'tissue_coding' => 'required|unique:tissue_applies',
            'tissue_type' => 'required',
            'parent_id' => 'required',
            'tissue_order' => 'required',
        ]);

        //2、判断验证是否正确
        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError($validator->messages());
        }

        //3、接受参数并且保存数据
       $tissue =  TissueApply::create([
            'tissue_name' => $request->get('tissue_name'),
            'tissue_coding' => $request->get('tissue_coding'),
            'tissue_type' => $request->get('tissue_type'),
            'parent_id' => $request->get('parent_id'),
            'tissue_order' => $request->get('tissue_order'),
        ]);

        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'massage' => '创建成功！',
            'data' => $tissue->toArray()
        ]);
    }
}