<?php

namespace App\Services;

use App\Models\Photo;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class GlobalService extends BaseController
{

    public static function list($request)
    {
        try {
            $limit = $request->limit ?? 10;
            $keyword = $request->q ?? '';
            $results = Photo::with(['media', 'user'])->where('status', 1);
            if (isset($keyword) && !empty($keyword)) {
                $results->where(function ($q) use ($keyword) {
                    $q->where('title', 'LIKE', '%' . $keyword . '%');
                    $q->orWhereHas('user', function ($q) use ($keyword){
                        $q->where('name', 'LIKE', '%' . $keyword . '%');
                    });
                });
            }
            $paginatedData = $results->orderBy('id', 'desc')->paginate($limit);
            return ['status' => 200, 'data' => $paginatedData];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

    public static function single($request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'id' => 'required',
                ]
            );
            if ($validator->fails()) {
                return ['status' => 500, 'errors' => $validator->errors()];
            }
            $photography = Photo::with([ 'media', 'user'])->where('id', $request->id)->first();
            if($photography == null){
                return ['status' => 500, 'errors' => 'data not found'];
            }
            return ['status' => 200, 'data' => $photography];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

}
