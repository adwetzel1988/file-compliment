<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['file_path', 'file_name', 'note_id'];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
