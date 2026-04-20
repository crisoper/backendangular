<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    // 📄 GET /api/comments
    public function index()
    {
        return response()->json(
            Comment::with('post')->get()
        );
    }

    // 📄 POST /api/comments
    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'name'    => 'required|string',
            'email'   => 'required|email',
            'body'    => 'required|string',
        ]);

        $comment = Comment::create($data);

        return response()->json($comment, 201);
    }

    // 📄 GET /api/comments/{id}
    public function show($id)
    {
        $comment = Comment::with('post')->findOrFail($id);

        return response()->json($comment);
    }

    // 📄 PUT /api/comments/{id}
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $data = $request->validate([
            'name'  => 'sometimes|string',
            'email' => 'sometimes|email',
            'body'  => 'sometimes|string',
        ]);

        $comment->update($data);

        return response()->json($comment);
    }

    // 📄 DELETE /api/comments/{id}
    public function destroy($id)
    {
        Comment::destroy($id);

        return response()->json([
            'message' => 'Comment deleted successfully'
        ]);
    }

}
