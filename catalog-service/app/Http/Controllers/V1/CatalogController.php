<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        return response()->json(['items' => []]);
    }

    public function show(string $id)
    {
        return response()->json(['id' => (int) $id]);
    }

    public function store(Request $request)
    {
        return response()->json([
            'created' => true,
            'data' => $request->all(),
        ], 201);
    }

    public function update(Request $request, string $id)
    {
        return response()->json([
            'updated' => true,
            'id' => (int) $id,
            'data' => $request->all(),
        ]);
    }

    public function destroy(string $id)
    {
        return response()->json(null, 204);
    }
}

