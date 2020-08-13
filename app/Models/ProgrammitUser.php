<?php

namespace Programmit\Models;

// use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProgrammitUser extends Authenticatable
{
    use Notifiable;
    // use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_profile_id', 'username','verified_email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isRoot()
    {
        return $this->user_profile_id == 1;
    }

    public function username_view()
    {
        return ucfirst($this->username);
    }

    public function emailVerificationStatus()
    {
        if($this->verified_email)
            return [
                'text' =>'Verified',
                'css' => 'fa-check-circle-o text-success',
                'verified' => true,                
            ];

        return [
                'text' =>'Need Verification',
                'css' => 'fa-exclamation-circle text-warning',
                'verified' => false,                
            ];
    }

    public function scopeApprovedUser($query)
    {
        $query->where('user_id', session('auth_user_id'))->where('user_account_status_id', 5);
    }

    public function rootProfile()
    {
        return $this->hasOne('\App\RootProfile', 'user_id', 'id');
    }

    public function profileType()
    {
        return $this->hasOne('\App\UserProfile', 'profile_id', 'user_profile_id');
    }

    public function clientProfile()
    {
        return $this->hasOne('\App\ClientProfile', 'user_id', 'id');
    }

    public function getPlanViewName()
    {
        return strtolower($this->profileType->label);
    }

    public function accountStatus()
    {
        return $this->belongsTo('\Programmit\Models\ProgrammitUserAccountStatus');
    }

    public function accountStatusView()
    {
        return $this->accountStatus()->lable;
    }
}
