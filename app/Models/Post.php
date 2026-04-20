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

    // 🔗 RELACIÓN: Post tiene muchos comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
