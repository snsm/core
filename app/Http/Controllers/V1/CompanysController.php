<?php

namespace App\Http\Controllers\V1;
use App\Http\Controllers\ApiController;
use App\InsuranceType;
use Illuminate\Http\Request;
use App\Transformer\UserTransformer;


class CompanysController extends ApiController
{

    public function Index(){

    }

    //创建新增保险公司类型
    public function createCompanyType(Request $request){

        $validator = \Validator::make($request->input(), [
            'insurance_type_name' => 'required',
            'insurance_type_coding' => 'required|unique:insurance_types',
        ]);

        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError($validator->messages());
        }

        $insurance_type = InsuranceType::create($request->all());
        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'data' => $insurance_type->toArray()
        ]);
    }

    //更新保险公司类型
    public function updateCompanyType(Request $request){

        $validator = \Validator::make($request->input(), [
            'id' => 'required',
            'insurance_type_name' => 'required',
            'insurance_type_coding' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError($validator->messages());
        }

        $insurance_type = InsuranceType::find($request->input('id'));
        if(!$insurance_type){
            return $this->responseNotFount();
        }

        $insurance_type->insurance_type_name = $request->input('insurance_type_name');
        $insurance_type->insurance_type_coding = $request->input('insurance_type_coding');

        $insurance_type->save();

        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'data' => $insurance_type->toArray()
        ]);
    }

    //删除保险公司类型
    public function deleteCompanyType(Request $request){

        if(!$tissue = InsuranceType::find($request->input('id'))){
            return $this->responseNotFount();
        }
        $tissue->delete();
        return $this->setStatusCode(200)->response([
            'status' => 'success',
            'massage' => '删除成功！'
        ]);
    }


}