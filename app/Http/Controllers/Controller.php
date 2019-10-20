<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function resFail($data = [], $msg = 'fail', $status = 405, $code = 0)
    {
        return Response()->json([
            'data' => $data,
            'msg'  => $msg,
            'code' => $code
        ], $status);
    }

    public function resSuccess($data, $msg = 'success', $status = 200, $code = 1)
    {
        return Response()->json([
            'data' => $data,
            'msg'  => $msg,
            'code' => $code
        ], $status);
    }

    /**
     * @param \Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    public function generalExceptionHandler($e = null)
    {
        return Response()->json([
            'Error'    => 'Invalid Request',
            'DevError' => $e ? $e->getMessage() : "",
            'Code'     => isset($e) && $e ? $e->getCode() : 0
        ], 400);
    }

    /**
     * @param \Exception $ex
     * @return \Illuminate\Http\JsonResponse
     */
    public function queryExceptionHandler($ex)
    {
        return Response()->json([
            'Error'    => "Data error",
            'DevError' => isset($ex) && $ex ? $ex->getMessage() : "",
            'Code'     => 4096
        ], 400);
    }
}
