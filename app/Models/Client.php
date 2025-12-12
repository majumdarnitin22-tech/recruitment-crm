<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';
    public $incrementing = false; // UUID
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'company_name',
        'contact_person',
        'contact_email',
        'contact_phone',
        'address',
        'billing_rate',
        'notes',
        'created_by'
    ];

    public function jobProfiles()
    {
        return $this->hasMany(JobProfile::class);
    }
}
