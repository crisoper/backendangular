<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    // GET /api/posts
    public function index(Request $request)
    {
        $parametros = $request->all();
        $keySearch = Arr::get($parametros, 'keySearch', '');
        $bySearch = Arr::get($parametros, 'bySearch', 'title');

        $query = Post::with('comments');

        if ($keySearch !== '') {
            $query->where($bySearch, 'like', "%{$keySearch}%");
        }

        return response()->json(
            $query->get()
        );
    }

    // POST /api/posts
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'title'   => 'required|string',
            'body'    => 'required|string',
        ]);

        $post = Post::create($data);

        return response()->json($post, 201);
    }

    // GET /api/posts/{id}
    public function show(Request $request, $id)
    {
        $parametros = $request->all();
        $sort = Arr::get($parametros, 'sort', 'asc');

        $post = Post::with([
            'comments' => function ($query) use ($sort) {
                $query->orderBy('created_at', $sort);
            }
        ])
        ->findOrFail($id);

        return response()->json($post);
    }

    // PUT /api/posts/{id}
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $data = $request->validate([
            'user_id' => 'sometimes|integer',
            'title'   => 'sometimes|string',
            'body'    => 'sometimes|string',
        ]);

        $post->update($data);

        return response()->json($post);
    }

    // DELETE /api/posts/{id}
    public function destroy($id)
    {
        Post::destroy($id);

        return response()->json([
            'message' => 'Post deleted successfully'
        ]);
    }
}
