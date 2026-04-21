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

    // 🔗 RELACIÓN: Comment pertenece a un Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
