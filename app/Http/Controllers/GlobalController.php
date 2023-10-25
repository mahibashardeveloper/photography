<?php

namespace App\Http\Controllers;

use App\Services\GlobalService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class GlobalController extends BaseController
{

    public function list(Request $request){
        $rv = GlobalService::list($request);
        return response()->json($rv, 200);
    }

    public function single(Request $request){
        $rv = GlobalService::single($request);
        return response()->json($rv, 200);
    }

}
