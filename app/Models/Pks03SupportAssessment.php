<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pks03SupportAssessment extends Model
{
    protected $fillable = [
        'user_id',
        'assessed_by',
        'assessed_at',
        'bapas_available',
        'bapas_institution_name',
        'guidance_program_available',
        'conclusion',
        'notes',
    ];

    protected $casts = [
        'assessed_at' => 'date',
        'bapas_available' => 'boolean',
        'guidance_program_available' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function institutions()
    {
        return $this->hasMany(Pks03SupportInstitution::class, 'assessment_id');
    }
}
