<?php

namespace App\Models;

use App\Permissions\PermissionTrait;
use App\Traits\CommonAttributes;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CommonAttributes, PermissionTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'userid',
        'email',
        'gender',
        'dob',
        'password',
        'blood_group',
        'address',
        'phone',
        'photo',
        'joining_date',
        'employment_type',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'dob' => 'date',
        'joining_date' => 'date',
    ];

    public function scopeStaff($query)
    {
        return $query->where('is_superuser', 0);
    }

    public function getUserPhotoAttribute()
    {
        return $this->photo && file_exists("storage/{$this->photo}")
            ? asset("storage/{$this->photo}")
            : '';
            // : asset('theme/media/avatars/avatar3.jpg');
    }

    public function getGenderTextAttribute()
    {
        return $this->gender == 1 ? 'Male' : ($this->gender == 2 ? 'Female' : 'Other');
    }

    public function getAgeAttribute()
    {
        return $this->dob ? Carbon::parse($this->dob)->diffInYears(Carbon::now()) : 'N/A';
    }

    public function getPhotoPathAttribute()
    {
        return $this->photo
            ? asset("storage/{$this->photo}")
            : asset('theme/media/avatars/avatar3.jpg');
    }

    public function getNameWithCodeAttribute()
    {
        return "{$this->name} ($this->userid)";
    }

    public function getBloodGroupTextAttribute()
    {
        return $this->blood_group
            ? Config::get('constants.blood_groups')[$this->blood_group]
            : 'N/A';
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withPivot('is_primary');
    }

    public function assigned_clients()
    {
        return $this->belongsToMany(Client::class, 'client_clinician_assigns', 'clinician_id', 'client_id')
            ->withPivot(['assigned_by_user_id', 'assign_request_id', 'release_date']);
    }

    public function timeslots()
    {
        return $this->belongsToMany(Timeslot::class, 'clinician_timeslot')->withPivot('weekday');
    }

    public function clinical_sessions()
    {
        return $this->hasMany(ClinicalSession::class, 'host_clinician_id');
    }

    public function guest_sessions()
    {
        return $this->belongsToMany(ClinicalSession::class, 'clinical_session_guest_clinicians', 'clinician_id', 'clinical_session_id')
            ->withPivot('clinician_id', 'accept_status', 'clinical_session_id');
    }
}
