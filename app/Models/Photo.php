<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Photo extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'avatar',
        'title',
        'status',
    ];

    public function media(){
        return $this->hasOne(Media::class, 'id' , 'avatar');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
