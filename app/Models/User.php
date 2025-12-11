<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $incrementing = false; // UUID
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'role',
        'password_hash',
        'is_active',
        'timezone',
    ];

    protected $hidden = [
        'password_hash',
    ];
}
