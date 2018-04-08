<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all());
    }

    public function friends(){
        return response()->json(Auth::user()->friends);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function addFriend($userId)
    {
        $friendToAdd = User::find($userId);
        $loggedUser = Auth::user();

        if (!$friendToAdd) {
            return response()->json([ 'error' => "There is no user you are trying to add to friends."], 400);  
        }

        if ($friendToAdd->id === $loggedUser->id) {
            return response()->json([ 'error' => "You can't add yourself to friends."], 400);  
        }

        if ($loggedUser->hasFriendWithId($friendToAdd->id)) {
            return response()->json([ 'error' => 'You are friends already.'], 400);              
        }

        $loggedUser->addFriendById($friendToAdd->id);

        return response()->json([
            'success' => true
        ]);
    }


    


    public function removeFriend($userId)
    {
        $friendToAdd = User::find($userId);
        $loggedUser = Auth::user();

        if (!$friendToRemove) {
            return response()->json([ 'error' => "There is no user you are trying to remove to friends."], 400);  
        }

        if ($friendToRemove->id === $loggedUser->id) {
            return response()->json([ 'error' => "You can't remove yourself to friends."], 400);  
        }

        if ($loggedUser->hasFriendWithId($friendToRemove->id)) {
            return response()->json([ 'error' => 'You are friends already.'], 400);              
        }

        $loggedUser->addFriendById($friendToRemove->id);

        return response()->json([
            'success' => true
        ]);
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


    
}
