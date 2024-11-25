<?php

namespace App\Models;

use Laravel\Prompts\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class label extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];

    // Relasi many-to-many dengan Note
    public function notes()
    {
        return $this->belongsToMany(Note::class, 'note_label');
    }
}
