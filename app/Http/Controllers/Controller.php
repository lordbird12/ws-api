<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function returnSuccess($massage, $data)
    {

        return response()->json([
            'code' => strval(200),
            'status' => true,
            'message' => $massage,
            'data' => $data,
        ], 200);
    }

    public function returnUpdate($massage)
    {
        return response()->json([
            'code' => strval(201),
            'status' => true,
            'message' => $massage,
            'data' => [],
        ], 201);
    }

    public function returnUpdateReturnData($massage, $data)
    {
        return response()->json([
            'code' => strval(201),
            'status' => true,
            'message' => $massage,
            'data' => $data,
        ], 201);
    }

    public function returnErrorData($massage, $code)
    {
        return response()->json([
            'code' => strval($code),
            'status' => false,
            'message' => $massage,
            'data' => [],
        ], 404);
    }

    public function returnError($massage)
    {
        return response()->json([
            'code' => strval(401),
            'status' => false,
            'message' => $massage,
            'data' => [],
        ], 401);
    }

    public function Log($userId, $description, $type)
    {
        $Log = new Log();
        $Log->user_id = $userId;
        $Log->description = $description;
        $Log->type = $type;
        $Log->save();
    }

   

}
