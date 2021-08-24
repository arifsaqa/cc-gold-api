<?php

namespace App\Http\Controllers;

use App\Models\Refferal;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RefferalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $refferals = Refferal::where('id', '=', $id)->first();

        return response()->json([
            "status" => 1,
            "saldo" => $refferals,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user)
    {
        Refferal::create([
            'userId' => $user->id,
            'refferal' => $user->id . Str::random($length = 10),
            "created_at" =>  Carbon::now(),
            "updated_at" => Carbon::now(),
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
        $refferal = Refferal::where('refferal', '=', $request->refferal)->first();
        $refferal->userList = $request->id;
        $refferal->save();

        return response()->json([
            'status'=> 1,
            'user'=>$refferal,
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
