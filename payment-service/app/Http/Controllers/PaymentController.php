<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'list payments']);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'create payment'], 201);
    }

    public function show(string $id)
    {
        return response()->json(['message' => 'show payment', 'id' => $id]);
    }

    public function update(Request $request, string $id)
    {
        return response()->json(['message' => 'update payment', 'id' => $id]);
    }

    public function destroy(string $id)
    {
        return response()->json(['message' => 'delete payment', 'id' => $id]);
    }
}
