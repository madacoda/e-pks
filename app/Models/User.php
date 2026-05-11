<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name', 'national_id', 'email', 'password', 'role', 'date_of_birth', 'place_of_birth', 'gender', 'religion', 'education', 'occupation', 'address', 'crime', 'pasal', 'sub_pasal', 'jenis_tindak_pidana', 'sentence', 'sentence_hours', 'avatar', 'placement_id', 'location_id',
    'pks02_prosecutor_name', 'pks02_case_number', 'pks02_opinion_analysis', 'pks02_opinion_recommendation', 'pks02_opinion_conclusion',
    'nationality', 'marital_status', 'dependents_count', 'spouse_name', 'children_count', 'ktp_address', 'phone_number',
    'pks02_background', 'pks02_family_profile', 'pks02_environment', 'pks02_daily_life', 'pks02_work_capability', 'pks02_profiling_meta',
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
            'pks02_background' => 'array',
            'pks02_family_profile' => 'array',
            'pks02_environment' => 'array',
            'pks02_daily_life' => 'array',
            'pks02_work_capability' => 'array',
            'pks02_profiling_meta' => 'array',
            'marital_status' => 'string',
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

    public function assignedPidana()
    {
        return $this->belongsToMany(User::class, 'jaksa_pidana', 'jaksa_id', 'pidana_id')
            ->withPivot('assigned_at')
            ->withTimestamps();
    }

    public function assignedJaksa()
    {
        return $this->belongsToMany(User::class, 'jaksa_pidana', 'pidana_id', 'jaksa_id')
            ->withPivot('assigned_at')
            ->withTimestamps();
    }

    public function getTotalSupervisedHours(): float
    {
        return $this->supervisions()
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->get()
            ->sum(function ($supervision) {
                $start = Carbon::parse($supervision->start_time);
                $end = Carbon::parse($supervision->end_time);

                return $end->diffInMinutes($start) / 60;
            });
    }

    public function pks03Assessment()
    {
        return $this->hasOne(Pks03SupportAssessment::class, 'user_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
