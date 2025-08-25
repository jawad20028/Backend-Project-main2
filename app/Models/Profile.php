<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'username', 'birthday', 'profile_picture', 'about_me'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}