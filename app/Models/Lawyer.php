<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'specialization_id', 'specialization', 'experience', 'bio', 'profile_image', 
        'consultation_fee', 'is_approved', 'title', 'education', 'rating', 'reviews_count',
        'address', 'phone', 'email_contact', 'website', 'consultation_duration', 'has_discount', 'is_verified',
        // Keep legacy
        'subtitle',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function timeSlots()
    {
        return $this->hasMany(TimeSlot::class);
    }

    public function practiceAreas()
    {
        return $this->hasMany(PracticeArea::class);
    }
}