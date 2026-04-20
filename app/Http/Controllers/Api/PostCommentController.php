<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{

    // GET /posts/{id}/comments
    public function index(Post $post)
    {
        return response()->json(
            $post->comments
        );
    }

    // POST /posts/{id}/comments
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email',
            'body'  => 'required|string',
        ]);

        $comment = $post->comments()->create($data);

        return response()->json($comment, 201);
    }

}
