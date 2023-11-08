<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'note_id', 'created_by', 'shared_to',
    ];

    public function note()
    {
        return $this->belongsTo(Note::class, 'note_id');
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sharedUser()
    {
        return $this->belongsTo(User::class, 'shared_to');
    }
}
