<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(string $version)
    {
        return response()->json(['version' => $version, 'method' => 'index']);
    }

    public function store(Request $request, string $version)
    {
        return response()->json([
            'version' => $version,
            'method' => 'store',
            'data' => $request->all(),
        ]);
    }

    public function show(string $version, string $id)
    {
        return response()->json([
            'version' => $version,
            'method' => 'show',
            'id' => $id,
        ]);
    }

    public function update(Request $request, string $version, string $id)
    {
        return response()->json([
            'version' => $version,
            'method' => 'update',
            'id' => $id,
            'data' => $request->all(),
        ]);
    }

    public function destroy(string $version, string $id)
    {
        return response()->json([
            'version' => $version,
            'method' => 'destroy',
            'id' => $id,
        ]);
    }
}
