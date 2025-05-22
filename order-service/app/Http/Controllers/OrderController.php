<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all());
    }

    public function store(Request $request)
    {
        $order = Order::create($request->only(['user_id','items','total','status']));
        return response()->json($order, 201);
    }

    public function show(Order $order)
    {
        return response()->json($order);
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->only(['user_id','items','total','status']));
        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->noContent();
    }
}
