<?php

namespace App\Http\Controllers\V1;
use App\Company;
use App\Http\Controllers\ApiController;
use App\Insurance;
use App\InsuranceType;
use Illuminate\Http\Request;
use App\Transformer\UserTransformer;


class CompanysController extends ApiController
{

    //显示所有保险公司列表
    public function Index(){
        $tissue = Company::orderBy('company_order','desc')->get();
        if(!$tissue->toArray()){
            return $this->responseNotFount('暂无数据',422);
        }
        return $this->response([
            'status' => 'success',
            'data' => $tissue->toArray()
        ]);
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

        if(!$insurance_type = InsuranceType::find($request->input('id'))){
            return $this->responseNotFount();
        }
        $insurance_type->delete();
        return $this->setStatusCode(200)->response([
            'status' => 'success',
            'massage' => '删除成功！'
        ]);
    }


    //创建新增保险公司险种
    public function createInsurance(Request $request){

        $validator = \Validator::make($request->input(), [
            'insurance_name' => 'required',
            'insurance_coding' => 'required|unique:insurances',
        ]);

        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError($validator->messages());
        }

        $insurance_type = Insurance::create($request->all());
        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'data' => $insurance_type->toArray()
        ]);
    }

    //更新保险公司险种
    public function updateInsurance(Request $request){

        $validator = \Validator::make($request->input(), [
            'id' => 'required',
            'insurance_name' => 'required',
            'insurance_coding' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError($validator->messages());
        }

        $insurance = Insurance::find($request->input('id'));
        if(!$insurance){
            return $this->responseNotFount();
        }

        $insurance->insurance_name = $request->input('insurance_name');
        $insurance->insurance_coding = $request->input('insurance_coding');

        $insurance->save();

        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'data' => $insurance->toArray()
        ]);

    }

    //删除保险公司险种
    public function deleteInsurance(Request $request){

        if(!$insurance = Insurance::find($request->input('id'))){
            return $this->responseNotFount();
        }
        $insurance->delete();
        return $this->setStatusCode(200)->response([
            'status' => 'success',
            'massage' => '删除成功！'
        ]);
    }

    //创建新增保险公司
    public function createCompany(Request $request){

        $validator = \Validator::make($request->input(), [
            'company_name' => 'required',
            'company_coding' => 'required|unique:companys',
            'insurance_type_id' => 'required',
            'parent_id' => 'required',
            'company_order' => 'required',
            'insurance_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError($validator->messages());
        }

        $res = Company::all()->where('id','=',$request->get('parent_id'));
        if(!$res->toArray() && $request->get('parent_id') != 0){
            return $this->responseNotFount('父级ID错误或不存在',422);
        }

        $insurance_type = Company::create($request->all());
        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'data' => $insurance_type->toArray()
        ]);
    }

    //更新保险公司
    public function updateCompany(Request $request){

        $validator = \Validator::make($request->input(), [
            'id' => 'required',
            'company_name' => 'required',
            'company_coding' => 'required',
            'insurance_type_id' => 'required',
            'parent_id' => 'required',
            'company_order' => 'required',
            'insurance_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError($validator->messages());
        }

        $company = Company::find($request->input('id'));
        if(!$company){
            return $this->responseNotFount();
        }

        $company->company_name = $request->input('company_name');
        $company->company_coding = $request->input('company_coding');
        $company->insurance_type_id = $request->input('insurance_type_id');
        $company->parent_id = $request->input('parent_id');
        $company->company_order = $request->input('company_order');
        $company->insurance_id = $request->input('insurance_id');

        $company->save();

        return $this->setStatusCode(201)->response([
            'status' => 'success',
            'data' => $company->toArray()
        ]);
    }

    //删除保险公司
    public function deleteCompany(Request $request)
    {

        if (!$company = Company::find($request->input('id'))) {
            return $this->responseNotFount();
        }
        $company->delete();
        return $this->setStatusCode(200)->response([
            'status' => 'success',
            'massage' => '删除成功！'
        ]);
    }

}