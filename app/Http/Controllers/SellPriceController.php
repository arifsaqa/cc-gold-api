<?php

namespace App\Http\Controllers;

use App\Models\SellPrice;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class SellPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $prices = DB::table('sell_prices')->get();
        return response()->json(
            [
                'message' => "success",
                'data' => $prices,
                'status' => 1,
            ]
        );
    }

    public function getCurrentPrice(){
        $latestPrice = DB::table('sell_prices')->latest()->first();
        return response()->json(
            [
                'message' => "success",
                'data' => $latestPrice,
                'status' => 1,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $latestPrice = DB::table('sell_prices')
            ->latest()
            ->first();
        $lastCreated = '';
        $nowFormat = '';
        if ($latestPrice) {
            $timestamp = strtotime($latestPrice->created_at);
            $lastCreated = date('d', $timestamp);
        }
        $now = new DateTime();
        $nowFormat = $now->format('d');
        if ($nowFormat == $lastCreated) {
            return Redirect::back()->with('error', 'Maksimal perubahan harga sehari sekali');
        }
        $price = SellPrice::create([
            'price' => $request->get('price')
        ]);
        return redirect()->back()->with('success', 'Berhasil menambah harga');
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
        $data = SellPrice::find($id);
        return response()->json($data, 200);
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
