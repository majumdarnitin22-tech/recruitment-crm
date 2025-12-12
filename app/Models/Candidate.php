<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Candidate extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        // Auto-generate UUID
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'education',
        'last_salary', 'expected_salary', 'shift_preference',
        'client_id', 'job_profile_id', 'source', 'recruiter_id',
        'status', 'is_shortlisted', 'shortlist_reason',
        'doj', 'doj_reminder_sent', 'notes', 'cv_url'
    ];
}
