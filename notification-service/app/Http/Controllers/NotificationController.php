<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return response()->json(Notification::all());
    }

    public function store(Request $request)
    {
        $notification = Notification::create($request->only(['user_id','message','channel','status']));
        return response()->json($notification, 201);
    }

    public function show(Notification $notification)
    {
        return response()->json($notification);
    }

    public function update(Request $request, Notification $notification)
    {
        $notification->update($request->only(['user_id','message','channel','status']));
        return response()->json($notification);
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->noContent();
    }
}
