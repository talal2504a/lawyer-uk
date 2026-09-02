<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeArea extends Model
{
    use HasFactory;

    protected $fillable = ['lawyer_id', 'area_name'];

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
}