<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->roles->first()->slug == "superadmin" || auth()->user()->roles->first()->slug == "admin") {
            $notifications = Notification::orderBy('id', 'asc')->get();
        } else {
            $notifications = Notification::where('user_id', auth()->user()->id)->orderBy('id', 'asc')->get();
        }

        return view('notifications/index', [
            'notifications' => $notifications
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        $notification = Notification::find($request->notification_id);
        $notification->fill($request->only('state'))->update();

        return response()->json( 'work!' );  
    }

}
