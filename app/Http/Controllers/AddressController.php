<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $id = Auth::user()->where('status','=',true)->first()->id;
        // $address=[
        //     'address' => $request->address,
        //     'user_id' => $request->user_id,
        // ];

        if(!$id){
            return response()->json([
                'message' => 'Ha ocurrido un problema'
            ],404);
        }

        $address=[
            'address' => Hash::make($request->address),
            'user_id' => $id,
        ];

        if(Address::create($address)){
            return response()->json([
                'message' => 'Dirección guardada exitosamente',
                'address' => $address
            ],201);
        }else{
            return response()->json([
                'message' => 'Ha ocurrido un problema'
            ],404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = Auth::user()->where('status','=',true)->first();

        if(!$user){
            return response()->json([
                'message' => 'Ha ocurrido un problema'
            ],404);
        }

        $address = $user->address()->where('id','=',$id)->first();

        if(!$address){
            return response()->json([
                'message' => 'Lo sentimos, no se encontro dirección'
            ],404);
        }

        return $address;

        // $address =  Address::find($id);
        // return  $address; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $user = Auth::user()->where('status','=',true)->first();

        if(!$user){
            return response()->json([
                'message' => 'Ha ocurrido un problema'
            ],404);
        }

        $address = $user->address()->where('id','=',$id)->first();

        if(!$address){
            return response()->json([
                'message' => 'Lo sentimos, no se encontro dirección'
            ],404);
        }

        $address -> address = Hash::make($request->address);

        if($address->save()){
            return response()->json([
                'message' => 'Dirección actualizada exitosamente',
                'address' => $address
            ],200);
        }else{
            return response()->json([
                'message' => 'Ha ocurrido un problema'
            ],404);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = Auth::user()->where('status','=',true)->first();

        if(!$user){
            return response()->json([
                'message' => 'Ha ocurrido un problema'
            ],404);
        }

        $address = $user->address()->where('id','=',$id)->first();

        if(!$address){
            return response()->json([
                'message' => 'Lo sentimos, no se encontro dirección'
            ],404);
        }
        

        if($address->delete()){
            return response()->json([
                'message' => 'Dirección eliminada exitosamente'
            ],200);
        }else{
            return response()->json([
                'message' => 'Ha ocurrido un problema'
            ],404);
        }
    }
}
