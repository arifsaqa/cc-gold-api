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
        $data = DB::table('transactions')->where(['userId'=> $id,'status'=>1])->orderBy('created_at', 'desc')->limit(5)->get();

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
        $saldo = 100000;
        $validator = Validator::make($request->all(), [
            'type' => 'required|integer',
            'total' => 'required|integer',
            'gram' => 'required'|'integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $transactionType = $request->get('type');
        switch ($transactionType) {
            case 1:
               $currentSaldo = $saldo + $request->get('gram');
                break;
            case 2:
                $currentSaldo = $saldo - $request->get('gram');
                break;
            case 3:
                $currentSaldo = $saldo - $request->get('gram');
                // $destionationUser = User::where('nohp', $request->get('destinationNumber'))->first();
                // $prevDesintySaldo = $destionationUser->saldo;
                // $newDestinySaldo = $prevDesintySaldo + $request->get('gram');
                // $destionationUser->update(['saldo' => $newDestinySaldo]);
                break;
            case 4:
                $currentSaldo = $saldo + $request->get('gram');
                break;
            
            default:
                # code...
                break;
        }

        $transaction = Transaction::create([
            'userId' => $id,
            'type' => $request->get('type'),
            'gram' => $request->get('gram'),
            'prevSaldo' => $request->get('prevSaldo'),
            'currentSaldo' => $currentSaldo,
            'biayaAdmin' => $request->get('biayaAdmin'),
            'price' => $request->get('price'),
            'total' => $request->get('total'),
            'status' => false,
            'discount' => $request->get('discount'),
            'destinationNumber' => $request->get('destinationNumber'),
            'message' => $request->get('message'),
        ]);

        $user = User::find($id);
        $updateUserSaldo = $user->update(['saldo'=>$currentSaldo]);

        if ($updateUserSaldo && $transaction) {
            return response()->json([
                'data' => $transaction,
                'status' => 1,
                'message' => 'sukses'
            ], 201);
        }else {
            return response()->json([
                'data' => $transaction,
                'status' => 0,
                'message' => 'gagal'
            ], 201);
        }

    }

    protected function saldoCalculation($type,$prevSaldo, $currentSaldo){
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
