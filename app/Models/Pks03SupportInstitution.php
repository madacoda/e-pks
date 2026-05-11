<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pks03SupportInstitution extends Model
{
    protected $fillable = [
        'assessment_id',
        'institution_name',
        'service_type',
        'address_contact',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function assessment()
    {
        return $this->belongsTo(Pks03SupportAssessment::class, 'assessment_id');
    }
}
