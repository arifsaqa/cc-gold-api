<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
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
        $data = Transaction::with('userDestinationByNumber')->where(['userId' => $id])->orderBy('created_at', 'desc')->limit(5)->get();

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
        $rules = [
            'payment' => 'required|integer',
            'type' => 'required|integer',
            'gram' => 'required',
            'priceId' => 'required|integer',
            'adminFee' => 'required|integer',
            'nominal' => 'required|integer',
            'discount' => 'required|integer',
            'barcode' => 'required|string',
        ];
        if ($request->get('type') == 3) {
            $rulesplus = [
                'destinationNumber' => 'required|string',
            ];
            $rules = array_merge($rules, $rulesplus);
            $userNumber = User::where('phone', '=', $request->get('destinationNumber'))->first();
            if ($userNumber == null) {
                return response()->json([
                    "status" => 0,
                    "message" => "Nomor tujuan tidak terdaftar",
                ], 200);
            }
        }
        $request->validate($rules);
        $data = Transaction::create([
            'userId' => (int)$id,
            'payment' => $request->get('payment'),
            'type' => $request->get('type'),
            'gram' => $request->get('gram'),
            'adminFee' => $request->get('adminFee'),
            'priceId' => $request->get('priceId'),
            'nominal' => $request->get('nominal'),
            'status' => 0,
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
    public function failedStatus($id)
    {
        $transaction =  Transaction::where('id', '=', $id)->first();
        $transaction->status = 2;
        $transaction->message = "Transaksi ditolak mohon hubungi Admin";
        $transaction->save();
        return redirect()->back()->with('success', 'berhasil menolak transaksi');
    }
    public function updateStatus($id)
    {
        try {
            $transaction =  Transaction::where('id', '=', $id)->first();
            $type = $transaction->type;
            switch ($type) {
                case 1:
                    $saldo = Saldo::where('userId', '=', $transaction->userId)->first();
                    $saldoActual = $saldo->gram+$transaction->gram;
                    $saldo->gram = $saldoActual;
                    $saldo->save();

                    $transaction->status = 1;
                    $transaction->save();
                    return redirect()->back()->with('success', 'Status berhasil diubah');
                    break;

                case 2:
                    $saldo = Saldo::where('userId', '=', $transaction->userId)->first();
                    if ($saldo->gram<$transaction->gram) {
                        return redirect()->back()->with('error', 'Gagal saldo tidak mencukupi');
                    }
                    $saldoActual = $saldo->gram-$transaction->gram;
                    $saldo->gram = $saldoActual;
                    $saldo->save();

                    $transaction->status = 1;
                    $transaction->save();
                    return redirect()->back()->with('success', 'Status berhasil diubah');
                    break;
                case 3:
                    $destination = User::where('phone', '=',$transaction->destinationNumber)->first();
                    $from = User::where('id', '=',$transaction->userId)->first();
                    $saldoFrom = Saldo::where('userId', '=', $transaction->userId)->first();
                    $saldoTo = Saldo::where('userId', '=', $destination->id)->first();

                    $saldoFrom = Saldo::where('userId', '=', $transaction->userId)->first();
                    if ($saldoFrom->gram<=$transaction->gram) {
                        return redirect()->back()->with('error', 'Gagal saldo tidak mencukupi');
                    }

                    $saldoActualFrom = $saldoFrom->gram-$transaction->gram;
                    $saldoFrom->gram = $saldoActualFrom;
                    $saldoFrom->save();

                    $saldoActualTo = $saldoTo->gram+$transaction->gram;
                    $saldoTo->gram = $saldoActualTo;
                    $saldoTo->save();

                    $transaction->status = 1;
                    $transaction->save();

                    Transaction::create([
                        'userId' => $destination->id,
                        'payment' => $transaction->payment,
                        'type' => 4,
                        'gram' => $transaction->gram,
                        'adminFee' => 0,
                        'priceId' => $transaction->priceId,
                        'nominal' => $transaction->nominal,
                        'status' => 1,
                        'discount' => $transaction->discount,
                        'destinationNumber' => $from->phone,
                        'message' => $transaction->message,
                        'barcode' => $transaction->barcode,
                    ]);

                    return redirect()->back()->with('success', 'Status berhasil diubah');

                    break;
            }
        } catch (\Throwable $th) {
            //throw $th;
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
}
