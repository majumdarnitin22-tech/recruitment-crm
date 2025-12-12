<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobProfile extends Model
{
    use HasFactory;

    protected $table = 'job_profiles';
    public $incrementing = false; // UUID
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'client_id',
        'title',
        'department',
        'location',
        'salary_min',
        'salary_max',
        'shift',
        'description',
        'openings',
        'status'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
