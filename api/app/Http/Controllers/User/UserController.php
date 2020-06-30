<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get();
        return response()->json($user, 200);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        $user = User::create(
            $request->only(
                'first_name',
                'last_name',
                'email',
                'role',
                'password',
            )
        );

        return response()->json([
            'query'=>$user,
            'message'=>'A new user has been added.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->first_name = $request->get('role');
        $user->save();

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return resposne()->json([
            'message' => 'A user has been removed.'
        ]);
    }

    public function retrieveDeleted()
    {
        $user = Client::onlyTrashed()->get();
        return response()->json($user, 200);
    }

    public function restoreUser($id) 
    {
        $user = User::withTrashed()->where('id', $id)->first();
        if($user != null) {
            $client->restore();
            return response()->json([
                'message' => 'An archived user has been restored.'
            ]);
        } else {
            return response()->json([
                'message' => 'This archived user does not exist.'
            ]);
        }
    }

    public function forceDestroy($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();
        if($user != null) {
            $user->forceDelete();
            return response()->json([
                'message' => 'An archived user has been deleted.'
            ]);
        } else {
            return response()->json([
                'message' => 'This archived user does not exist.'
            ]);
        }
    }
}
