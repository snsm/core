<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class ApiController extends Controller
{
    protected $statusCode = 200;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function responseNotFount($message = 'Not Fount',$status = '404')
    {
        return $this->setStatusCode($status)->responseError($message);
    }

    public function responseError($message)
    {
        return $this->response([
            'status' => 'failed',
            'errors' => [
                'status_code' => $this->getStatusCode(),
                'message' => $message,
            ]
        ]);
    }

    public function response($data)
    {
        return response()->json($data,$this->getStatusCode());
    }

}
