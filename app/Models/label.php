<?php

namespace App\Models;

use App\Models\catatan;
use Laravel\Prompts\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class label extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];

    public function catatan()
    {
        return $this->hasMany(catatan::class);
    }
}
