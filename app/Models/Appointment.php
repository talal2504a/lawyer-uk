<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'lawyer_id', 'city', 'case_type', 'budget', 'attachment_path',
        'appointment_date', 'time_slot', 'message', 'lawyer_response', 'customer_notes',
        'meeting_mode', 'meeting_location', 'consultation_fee', 'advance_required',
        'rejection_reason', 'suggested_lawyer_id',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function lawyer()
    {
        return $this->belongsTo(User::class, 'lawyer_id');
    }

    public function suggestedLawyer()
    {
        return $this->belongsTo(User::class, 'suggested_lawyer_id');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}