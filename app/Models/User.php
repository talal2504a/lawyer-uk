<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'city', 'user_type', 'status', 'profile_image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lawyer()
    {
        return $this->hasOne(Lawyer::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function appointmentsAsCustomer()
    {
        return $this->hasMany(Appointment::class, 'customer_id');
    }

    public function appointmentsAsLawyer()
    {
        return $this->hasMany(Appointment::class, 'lawyer_id');
    }

    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isLawyer()
    {
        return $this->user_type === 'lawyer';
    }

    public function isCustomer()
    {
        return $this->user_type === 'customer';
    }
}