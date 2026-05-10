<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name', 'national_id', 'email', 'password', 'role', 'date_of_birth', 'place_of_birth', 'gender', 'religion', 'education', 'occupation', 'address', 'crime', 'avatar', 'placement_id', 'sentence',
    'pks02_prosecutor_name', 'pks02_case_number', 'pks02_opinion_analysis', 'pks02_opinion_recommendation', 'pks02_opinion_conclusion',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }

    public function placement()
    {
        return $this->belongsTo(Placement::class);
    }

    public function supervisions(): HasMany
    {
        return $this->hasMany(Pks03Supervision::class);
    }
}
