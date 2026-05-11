<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupervisorComplaint extends Model
{
    protected $fillable = [
        'supervisor_name',
        'pidana_id',
        'compliance_notes',
    ];

    public function pidana()
    {
        return $this->belongsTo(User::class, 'pidana_id');
    }
}
