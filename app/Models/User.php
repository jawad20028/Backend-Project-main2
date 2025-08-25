<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'verjaardag',
        'about_me',
        'password',
        'email_verified_at',
        'is_admin',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'verjaardag' => 'date',
        'is_admin' => 'boolean',
    ];

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }
}