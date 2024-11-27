<?php

namespace App\Models;

use App\Models\label;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class catatan extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    // Relasi many-to-many dengan Label
    public function labels()
    {
        return $this->belongsTo(label::class);
    }
}
