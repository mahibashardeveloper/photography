<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class LoginTimeHistory extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $appends = ['created_at_formatted' ];

    public function getCreatedAtFormattedAttribute(){
        if(isset($this->attributes['created_at'])){
            return date('F j, Y, g:i a', strtotime($this->attributes['created_at']));
        }else{
            return null;
        }
    }

}
