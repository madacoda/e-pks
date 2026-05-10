<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pks03Supervision extends Model
{
    protected $fillable = [
        'user_id',
        'supervision_date',
        'supervision_type',
        'notes',
        'behavior_status',
        'compliance_status',
    ];

    protected $casts = [
        'supervision_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
