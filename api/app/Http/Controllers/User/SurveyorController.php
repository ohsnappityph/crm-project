<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SurveyorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('role', 'Building Surveyor')->get();
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
            'surveyor_timezone' => 'required',
            'surveyor_location' => 'required',
            'surveyor_address' => 'required',
            'surveyor_state' => 'required',
            'surveyor_city' => 'required',
            'surveyor_zip_code' => 'required',
            'surveyor_schedule_notes' => 'required',
            'surveyor_color_code' => 'required',
        ]);

        $user = User::create(
            $request->only(
                'first_name',
                'last_name',
                'email',
                'role',
                'password',
                'surveyor_timezone',
                'surveyor_location',
                'surveyor_address',
                'surveyor_state',
                'surveyor_city',
                'surveyor_zip_code',
                'surveyor_schedule_notes',
                'surveyor_color_code',
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
        $user->surveyor_timezone = $request->get('surveyor_timezone');
        $user->surveyor_location = $request->get('surveyor_location');
        $user->surveyor_address = $request->get('surveyor_address');
        $user->surveyor_state = $request->get('surveyor_state');
        $user->surveyor_city = $request->get('surveyor_city');
        $user->surveyor_zip_code = $request->get('surveyor_zip_code');
        $user->surveyor_schedule_notes = $request->get('surveyor_schedule_notes');
        $user->surveyor_color_code = $request->get('surveyor_color_code');
        $user->save();

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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

    public function restoreSurveyor($id) 
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
