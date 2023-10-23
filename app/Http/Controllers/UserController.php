<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{

    public function register(Request $request){
        $rv = UserService::register($request);
        return response()->json($rv, 200);
    }

    public function login(Request $request){
        $rv = UserService::login($request);
        return response()->json($rv, 200);
    }

    public function forget(Request $request){
        $rv = UserService::forget($request);
        return response()->json($rv, 200);
    }

    public function reset(Request $request){
        $rv = UserService::reset($request);
        return response()->json($rv, 200);
    }

    public function user_details(Request $request){
        $rv = UserService::user_details($request);
        return response()->json($rv, 200);
    }

    public function user_profile(Request $request){
        $rv = UserService::user_update($request);
        return response()->json($rv, 200);
    }

    public function user_password(Request $request){
        $rv = UserService::user_password($request);
        return response()->json($rv, 200);
    }

    public function user_logout(Request $request){
        $rv = UserService::user_logout($request);
        return response()->json($rv, 200);
    }

}
