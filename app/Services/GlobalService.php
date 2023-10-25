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
            // pagination value limit
            $limit = $request->limit ?? 10;

            // search value
            $keyword = $request->q ?? '';

            // every user's latest one photo show
            $singleData = Photo::selectRaw('MAX(id) as id')->groupBy('user_id');

            // here user and media use for visible user data and media for photo show
            $results = Photo::with([ 'media', 'user'])->whereIn('id', function ($query) use ($singleData) { $query->fromSub($singleData, 'latest_photos'); } )->where('status', 1);

            // search value declare
            if (isset($keyword) && !empty($keyword)) {
                $results->where(function ($q) use ($keyword) {
                    $q->where('title', 'LIKE', '%' . $keyword . '%');
                });
            }

            // pagination value declare
            $paginatedData = $results->orderBy('id', 'desc')->paginate($limit);

            // data return in json
            return ['status' => 200, 'data' => $paginatedData];
        } catch (\Exception $e) {
            return ['status' => 500, 'errors' => $e->getMessage(), 'line' => $e->getLine()];
        }
    }

}
