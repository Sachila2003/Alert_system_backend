<?php

namespace App\Http\Controllers;

use App\Models\Notices;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return auth()->user()->notices;
    }

    public function notifications(){
        return response()->json([
            'notifications' => auth()->user()->notifications
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:225',
            'expire_date' => 'required|date',
            'latest_maintance_date' => 'required|date',
            'user_id' => 'required|exists:users,id'
        ]);

        $notice = Notices::create($data);

        return response()->json([
            'message' => 'Notice created successfully',
            'notice' => $notice
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $notice = Auth::user()->notices()->find($id);

        if (!$notice) {
            return response()->json([
                'message' => 'Notice not found'
            ], 404);
        }

        return response()->json([
            'notice' => $notice
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notices $notices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notices $notices)
    {
        //
    }
}
