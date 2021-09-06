<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policies = Policy::all();
        if (!$policies->first()) {
            return response()->json([
                'status' => 0,
                'message' => 'data policy masih kosong',
                'data' => 'Belum ada data'
            ]);
        }
        return response()->json([
            'status' => 1,
            'message' => 'data policy berhasil didapatkan',
            'data' => $policies
        ]);
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
        try {
            $request->validate([
                'policy' => 'required|string'
            ]);
            Policy::create([
               'policy' => $request->policy,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now()
            ]);
            return view()->with('success', 'data Policy sudah tersimpan');
        } catch (\Throwable $th) {
            return view()->with('error', $th);
        }
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
