<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Witness extends Model
{
    use HasFactory;

    protected $fillable = [
        'complaint_id',
        'name',
        'contact',
        'email',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
