<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body', 'created_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function noteTags()
    {
        return $this->belongsToMany(Tag::class, 'note_tags')
            ->select(['tags.id', 'tags.tag']);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'note_tags')
            ->select(['tags.id', 'tags.tag'])
            ->as('tags');
    }
}
