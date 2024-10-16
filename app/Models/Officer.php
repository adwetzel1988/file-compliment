<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id', 'name', 'rank', 'division', 'badge_number',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
