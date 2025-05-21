<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AnalyticsController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['message' => 'index']);
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json(['message' => 'stored'], 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        return response()->json(['message' => 'updated', 'id' => $id]);
    }

    public function destroy(string $id): JsonResponse
    {
        return response()->json(['message' => 'deleted', 'id' => $id]);
    }
}
