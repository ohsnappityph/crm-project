<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::get();
        return response()->json($client, 200);
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
            'role' => 'nullable',
            'password' => 'nullable',
            'company_name' => 'required',
            'phone' => 'required',
            'createAccount' => 'required'
        ]);

        $client = Client::create(
            $request->only(
                'first_name',
                'last_name',
                'email',
                'company_name',
                'phone',
                'poc_first_name',
                'poc_last_name',
                'client_preferences',
                'first_name',
                'referred_by',
                'payment_info',
            )
        );

        if($request->createAccount == false) {
            $user = User::create(
                $request->only(
                    'first_name',
                    'last_name',
                    'email',
                    'role',
                    'password',
                )
            );
        } 

        return response()->json([
            'query' => $client,
            'message' => 'A new client has been added'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return response()->json($client, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->first_name = $request->get('first_name');
        $client->first_name = $request->get('last_name');
        $client->first_name = $request->get('email');
        $client->first_name = $request->get('company_name');
        $client->first_name = $request->get('phone');
        $client->first_name = $request->get('poc_first_name');
        $client->first_name = $request->get('poc_last_name');
        $client->first_name = $request->get('poc_relationship');
        $client->first_name = $request->get('client_preferences');
        $client->first_name = $request->get('referred_by');
        $client->first_name = $request->get('payment_info');
        $client->save();

        return response()->json($client, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([
            'message' => 'A client has been removed.'
        ]);
    }

    public function retrieveDeleted()
    {
        $client = Client::onlyTrashed()->get();
        return response()->json($client, 200);
    }    

    public function restoreClient($id)
    {
        $client = Client::withTrashed()->where('id', $id)->first();
        if($client != null) {
            $client->restore();
            return response()->json([
                'message' => 'An archived client has been restored.',
            ]);
        } else {
            return response()->json([
                'message' => 'This archived client does not exist.'
            ]);
        }
    }

    public function forceDestroy($id)
    {
        $client = Client::withTrashed()->where('id', $id)->first();
        if($client != null) {
            $client->forceDelete();
            return response()->json([
                'message' => 'An archived client has been restored.',
            ]);
        } else {
            return response()->json([
                'message' => 'This archived client does not exist.'
            ]);
        }
    }
}
