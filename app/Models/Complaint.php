<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'complaint_number',
        'description',
        'incident_date',
        'status',
        'outcome',
        'assigned_to',
        'action_taken',
        'complaint_type',
        'signature',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function officer()
    {
        return $this->hasOne(Officer::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function actionTaken()
    {
        return $this->hasOne(ActionTaken::class);
    }

    public function witnesses()
    {
        return $this->hasMany(Witness::class);
    }
}
