<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generic extends Model
{

    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'active',
        'created_at',
        'extra',
    ];

    protected $casts = [
        'created_at' => 'date',
        'active' => 'boolean',
    ];

    protected $appends = [
        'created_at_es'
    ];


    public function getCreatedAtEsAttribute()
    {
        return $this->created_at
            ? $this->created_at->locale('es')->translatedFormat('d/m/Y')
            : null;
    }
}
