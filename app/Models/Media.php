<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    use HasFactory;

    protected $hidden = [ 'created_at', 'updated_at' ];

    protected $appends = [ 'full_file_path', 'file_name' ];

    public function getFullFilePathAttribute()

    {

        if ($this->media_type == 2) {

            return asset('storage/media/file/'.$this->file_path);

        }

        return asset('storage/media/image/'.$this->file_path);

    }

    public function getFileNameAttribute()

    {

        if ($this->media_type == 2 || $this->media_type == 1) {

            $attr = unserialize($this->attrs);

            return $attr['filename'];

        }

        return null;

    }

}
