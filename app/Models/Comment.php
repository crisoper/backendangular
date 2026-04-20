<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    use HasFactory;

    protected $fillable = [
        'post_id',
        'name',
        'email',
        'body',
    ];

    // 🔗 RELACIÓN: Comment pertenece a un Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
