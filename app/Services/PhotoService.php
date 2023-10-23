<?php

namespace App\Services;

use App\Models\Photo;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PhotoService extends BaseController
{

    public static function create($request){
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'avatar' => 'required',
                    'title' => 'required',
                    'status' => 'required',
                ]
            );
            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $user_id = Auth::id();
            $photography = new Photo();
            $photography -> user_id = $user_id;
            $photography -> avatar = $request->avatar;
            $photography -> title = $request->title;
            $photography -> status = $request->status;
            $photography -> save();
            return ['status' => 200, 'msg' => 'data has been saved successfully'];
        }catch (\Exception $e){
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function list($request)
    {
        try {
            $user_id = Auth::id();
            $limit = $request->limit ?? 10;
            $keyword = $request->q ?? '';
            $results = Photo::with('media')->where('user_id', $user_id)->orderBy('id', 'desc');
            if (isset($keyword) && !empty($keyword)) {
                $results->where(function ($q) use ($keyword) {
                    $q->where('title', 'LIKE', '%' . $keyword . '%');
                });
            }
            $paginatedData = $results->paginate($limit);
            return ['status' => 200, 'data' => $paginatedData];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function single($request)
    {
        try {
            $user_id = Auth::id();
            $validator = Validator::make(
                $request->all(),
                [
                    'id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $photography = Photo::where('user_id', $user_id)->where('id', $request->id)->first();
            if($photography == null){
                return ['status' => 500, 'errors' => 'data not found'];
            }
            return ['status' => 200, 'data' => $photography];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function update($request)
    {
        try {
            $user_id = Auth::id();
            $validator = Validator::make(
                $request->all(),
                [
                    'avatar' => 'required',
                    'title' => 'required',
                    'status' => 'required',
                ]
            );
            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $photography = Photo::where('user_id', $user_id)->where('id', $request->id)->first();
            if($photography == null){
                return ['status' => 500, 'errors' => 'data not found'];
            }
            $photography->avatar = $request->avatar;
            $photography->title = $request->title;
            $photography->status = $request->status;
            $photography->save();
            return ['status' => 200, 'msg' => 'data has been updated successfully.'];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function delete($request)
    {
        try {
            Photo::whereIn('id', $request->ids)->delete();
            return ['status' => 200, 'msg' => 'data has been deleted successfully'];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

}
