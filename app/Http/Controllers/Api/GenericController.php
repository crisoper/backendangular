<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Generic;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class GenericController extends Controller
{

    // GET /api/generics
    public function index(Request $request)
    {
        $parametros = $request->all();
        $keySearch = Arr::get($parametros, 'keySearch', '');
        $bySearch = Arr::get($parametros, 'bySearch', 'title');

        $query = Generic::query();

        if ($keySearch !== '') {
            $query->where($bySearch, 'like', "%{$keySearch}%");
        }

        return response()->json(
            $query->get()
        );
    }

    // POST /api/generics
    public function store(Request $request)
    {
        $data = $request->validate([
            'code'          => 'required|integer',
            'description'   => 'required|string',
            'active'        => 'sometimes|boolean',
            'extra'         => 'sometimes|string',
        ]);

        $post = Generic::create($data);

        return response()->json($post, 201);
    }

    // GET /api/generics/{id}
    public function show(Request $request, $id)
    {
        $parametros = $request->all();
        $sort = Arr::get($parametros, 'sort', 'asc');

        $post = Generic::findOrFail($id);

        return response()->json($post);
    }


    // PUT /api/generics/{id}
    public function update(Request $request, $id)
    {
        $post = Generic::findOrFail($id);

         $data = $request->validate([
            'code'          => 'required|integer',
            'description'   => 'required|string',
            'active'        => 'sometimes|boolean',
            'extra'        => 'sometimes|string',
        ]);

        $post->update($data);

        return response()->json($post);
    }

    // DELETE /api/generics/{id}
    public function destroy($id)
    {
        Generic::destroy($id);

        return response()->json([
            'message' => 'Generic deleted successfully'
        ]);
    }

}
