<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Friend;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('friends.index', compact('user'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  int $friend_id
     */
    public function add($friend_id)
    {
        if (!friendship($friend_id)->exists && !friendship($friend_id)->accepted)
        {
            Friend::create([
                'user_id' => Auth::id(),
                'friend_id' => $friend_id,
            ]);
        }
        else
        {
            $this->accept($friend_id);
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $friend_id
     */
    public function accept($friend_id)
    {
        Friend::where([
            'user_id' => $friend_id,
            'friend_id' => Auth::id(),
        ])->update([
            'accepted' => 1
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $friend_id
     */
    public function destroy($friend_id)
    {
        Friend::where([
            'user_id' => Auth::id(),
            'friend_id' => $friend_id
        ])->orWhere([
            'user_id' => $friend_id,
            'friend_id' => Auth::id()
        ])->delete();

        return back();
    }
}
