<?php

namespace App\Http\Controllers;

use App\Models\SellPrice;
use Carbon\Carbon;
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
        $prices = SellPrice::latest()->first();
        return response()->json(
            [
                'message' => "success",
                'data' => $prices,
                'status' => 1,
            ]
        );
    }

    public function getCurrentPrice(){
        $latestPrice = DB::table('sell_prices')->orderBy('created_at', 'asc')->latest()->first();
        $diff = SellPrice::orderBy('created_at', 'asc')->limit(2)->get()->toArray();
        $diffNumb = $diff[1]['price'] - $diff[0]['price'];
        $percentChange = ($diffNumb / $diff[0]['price']) * 100;
        return response()->json(
            [
                'message' => "success",
                'data' => $latestPrice,
                'diff' => round($percentChange, 2),
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
        $data = SellPrice::find($id);
        return response()->json([
            'status' => 1,
            'data' => $data
        ]);
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
        $request->validate([
            'price' => 'required|string',
        ]);
        $sellPrice = SellPrice::find($id);
        $sellPrice->price = $request->price;
        $sellPrice->updated_at = Carbon::now();
        $savedData = $sellPrice->save();

        if ($savedData) {
            return redirect()->back()->with('success', 'data telah diubah');
        }
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
    public function graph($timeline)
    {
        switch ($timeline) {
            case 'weekly':
                $data = SellPrice::where('created_at', '>', Carbon::now()->subWeek(1))->orderBy('created_at','asc')->get();
                return response()->json(
                    [
                        'message' => "success",
                        'data' => $data,
                        'status' => 1,
                    ]
                );
                break;
            case 'monthly':
                $data = SellPrice::where('created_at', '>', Carbon::now()->subMonth(1))->orderBy('created_at','asc')->get();
                return response()->json(
                    [
                        'message' => "success",
                        'data' => $data,
                        'status' => 1,
                    ]
                );
                break;
            case 'yearly':
                $data = SellPrice::where('created_at', '>', Carbon::now()->subYear(1))->orderBy('created_at','asc')->get();
                return response()->json(
                    [
                        'message' => "success",
                        'data' => $data,
                        'status' => 1,
                    ]
                );
                break;
            case '3years':
                $data = SellPrice::where('created_at', '>', Carbon::now()->subYears(3))->orderBy('created_at','asc')->get();
                return response()->json(
                    [
                        'message' => "success",
                        'data' => $data,
                        'status' => 1,
                    ]
                );
                break;
            case '6years':
                $data = SellPrice::where('created_at', '>', Carbon::now()->subYears(6))->orderBy('created_at','asc')->get();
                return response()->json(
                    [
                        'message' => "success",
                        'data' => $data,
                        'status' => 1,
                    ]
                );

            default:
                # code...
                break;
        }
    }
}
