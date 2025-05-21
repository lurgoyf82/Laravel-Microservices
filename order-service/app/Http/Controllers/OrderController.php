<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'List of orders']);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Order created'], Response::HTTP_CREATED);
    }

    public function update(Request $request, $order)
    {
        return response()->json(['message' => "Order {$order} updated"]);
    }

    public function destroy($order)
    {
        return response()->json(['message' => "Order {$order} deleted"]);
    }
}
