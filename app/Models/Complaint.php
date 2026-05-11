<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'subject',
        'content',
        'status',
        'admin_response',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
