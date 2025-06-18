<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
            'track_number',

            'name',
            'surname',
            'fathername',

            'birthday',
            'phone',

            'series_passport',
            'number_passport',

            'comment',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected function casts(): array
    {
        return [

        ];
    }
}
