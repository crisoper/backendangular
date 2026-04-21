<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'created_at_es',
        'updated_at_es',
    ];

    public function getCreatedAtEsAttribute()
    {
        return $this->created_at
            ->locale('es')
            ->translatedFormat('d F Y H:i');
    }

    public function getUpdatedAtEsAttribute()
    {
        return $this->updated_at
            ->locale('es')
            ->translatedFormat('d F Y H:i');
    }

    // 🔗 RELACIÓN: Post tiene muchos comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
