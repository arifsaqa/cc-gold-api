<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $data = DB::table('transactions')->where(['userId' => $id])->orderBy('created_at', 'desc')->limit(5)->get();

        $status = 1;

        return response()->json(compact(
            'status',
            'data'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'payment' => 'required|integer',
            'type' => 'required|integer',
            'gram' => 'required|integer',
            'priceId' => 'required|integer',
            'adminFee' => 'required|integer',
            'nominal' => 'required|integer',
            'discount' => 'required|integer',
            'barcode' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $data = Transaction::create([
            'userId' => $id,
            'payment' => $request->get('payment'),
            'type' => $request->get('type'),
            'gram' => $request->get('gram'),
            'adminFee' => $request->get('adminFee'),
            'priceId' => $request->get('priceId'),
            'nominal' => $request->get('nominal'),
            'status' => false,
            'discount' => $request->get('discount'),
            'destinationNumber' => $request->get('destinationNumber'),
            'message' => $request->get('message'),
            'barcode' => $request->get('barcode'),
        ]);
        $status = 1;
        return response()->json(compact(
            'status',
            'data'
        ));
    }

      public function uploadBarcode(Request $request)
    {

        if ($files = $request->file('image')) {
            $destinationPath = 'public/images/transactions/'; // upload path
            $imageName = date('YmdHis') . "." . $files->getClientOriginalExtension();
            // $ikan['image'] = "$imageName";
            $files->move($destinationPath, $imageName);

            $forDB = $destinationPath . $imageName;
        }
        return response()->json([
            "status" => 1,
            "message" => "sukses",
            "location" => $forDB
        ], 201);

    }
    protected function saldoCalculation($type, $prevSaldo, $currentSaldo)
    {
        // case 'value':
        //     # code...
        //     break;
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
        $transaction =  Transaction::find($id)->first();

        $total = $transaction->total;
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
