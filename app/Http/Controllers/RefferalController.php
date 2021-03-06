<?php

namespace App\Http\Controllers;

use App\Models\Point;
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
        $points = Point::where('userId', '=', $refferal->userId)->first();

        $userList = json_decode($refferal->userList);
        if ($userList == null) {
            $refferal->userList = json_encode([$request->userId]);
        }else{
            foreach ($userList as $value) {
                if ($value == $request->userId) {
                    return response()->json([
                        'status' => 0,
                        'message' => "User sudah menggunakan referral ini"
                    ]);
                }
            }
            array_push($userList, $request->userId);
            $refferal->update(['userList' => $userList]);
            $points->point += 1;
            $points->save();
        }
        $refferal->save();

        return response()->json([
            'status'=> 1,
            'data'=>$refferal,
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
