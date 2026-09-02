<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = ['lawyer_id', 'slot_date', 'slot_time', 'is_booked'];

    protected $casts = [
        'slot_date' => 'date',
        'slot_time' => 'datetime:H:i',
    ];

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
}