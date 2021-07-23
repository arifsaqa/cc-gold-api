<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $saldo = Saldo::where("userId",$id)->first();

        return response()->json([
            "status" => 1,
            "saldo" => $saldo,
        ], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       Saldo::create([
           'userId' => $request->get('userId'),
           'gram' => $request->get('gram'),
       ]);

       return response()->json(['status'=>1, 'mesage'=>'sukses']);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        $isLoggedin = JWTAuth::parseToken()->authenticate();
        if (!$isLoggedin) {
            return response()->json([
                "status" => 0,
                "message" => "You are not allowed to update data",
            ], 400);
        }

        $saldo = Saldo::find($id);
        $saldo->update(['gram'=>$request->get('gram')]);
        
        return response()->json(['status'=>1, 'message'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $isAdmin = JWTAuth::parseToken()->authenticate();
        if ($isAdmin->role == 0) {
            return response()->json([
                "status" => 0,
                "message" => "You are not an admin",
            ], 400);
        }

        $saldo = Saldo::find($id);
        $saldo->delete();

        return response()->json(['status'=>1, 'message'=>'berhasil']);
    }
}
