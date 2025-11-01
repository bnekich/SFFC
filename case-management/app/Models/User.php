<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable, SoftDeletes;

    protected $casts = [
        'dashboard_preferences' => 'array',
    ];

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phone',
        'email_verified_at',
        'password',
        'force_password_reset',
        'dashboard_preferences',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'force_password_reset' => 'boolean'
        ];
    }
    public function routeNotificationForSms($notification)
    {
        return $this->phone;
    }

    public function routeNotificationForEmail($notification)
    {
        return $this->email;
    }

    public function fullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}
