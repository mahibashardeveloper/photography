<?php

namespace App\Http\Controllers;

use App\Services\PhotoService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PhotoController extends BaseController
{

    public function create(Request $request){
        $rv = PhotoService::create($request);
        return response()->json($rv, 200);
    }

    public function list(Request $request){
        $rv = PhotoService::list($request);
        return response()->json($rv, 200);
    }

    public function single(Request $request){
        $rv = PhotoService::single($request);
        return response()->json($rv, 200);
    }

    public function update(Request $request){
        $rv = PhotoService::update($request);
        return response()->json($rv, 200);
    }

    public function delete(Request $request){
        $rv = PhotoService::delete($request);
        return response()->json($rv, 200);
    }

}
