<?php

namespace App\Services;

use App\Models\Media;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MediaService
{

    public static function upload($request)
    {
        try {
            // Get the input data from the request
            $input = $request->all();

            // Validate the input data
            $validator = Validator::make($input, [
                'file' =>  'required|file',
                'media_type' => 'required|integer', //1.image 2. video 3. file
            ]);
            if ($validator->fails()) {
                return ['status' => 500, 'error' => $validator->errors()];
            }

            // Retrieve the uploaded file
            $image_file = $request->file('file');

            // Get file information
            $attrs = array(
                'filename' => $image_file->getClientOriginalName(),
                'extension' => $image_file->getClientOriginalExtension(),
                'size' => $image_file->getSize(),
                'mimeType' => $image_file->getMimeType()
            );

            // Determine the storage path based on media_type
            if ($input['media_type'] == 1) {
                $filePath = Storage::disk('public')->put('/media/image', $input['file']);
            } else {
                $file_name = time() . '-' . strtolower(str_replace(' ', '-', $attrs['filename']));
                $filePath = '/media/file/' . $file_name;

                // Store the file in the specified path
                Storage::disk('public')->put($filePath, file_get_contents($image_file));
            }

            // Extract the new file name
            $new_name = basename($filePath);

            // Create a new Media model
            $MediaModel = new Media();
            $MediaModel->file_path = $new_name;
            $MediaModel->media_type = $input['media_type'];
            $MediaModel->attrs = serialize($attrs);
            $MediaModel->created_at = Carbon::now();
            $MediaModel->save();

            return ['status' => 200, 'data' => $MediaModel, 'file_name' => $image_file->getClientOriginalName(), 'msg' => 'Data has been added successfully'];
        } catch (\Exception $e) {
            return ['status' => 500, 'error' => $e->getMessage()];
        }
    }

}
