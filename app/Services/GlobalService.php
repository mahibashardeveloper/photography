<?php

namespace App\Services;

use App\Models\Photo;
use Illuminate\Routing\Controller as BaseController;

class GlobalService extends BaseController
{

    public static function list($request)
    {
        try {
            $limit = $request->limit ?? 10;
            $keyword = $request->q ?? '';
            $results = Photo::with('media')->orderBy('id', 'desc');
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

}
