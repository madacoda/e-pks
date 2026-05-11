<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'placement_id',
        'name',
        'address',
        'pic_name',
        'phone',
        'latitude',
        'longitude',
    ];

    public function placement(): BelongsTo
    {
        return $this->belongsTo(Placement::class);
    }
}
