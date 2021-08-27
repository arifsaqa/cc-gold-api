<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PaymentMethod::all();
        $status = 1;
        return response()->json(compact('status', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/payments'), $imageName);
        PaymentMethod::create([
            'name' => $request->get('name'),
            'logo' =>  asset('images/payments/'.$imageName),
        ]);

        return redirect()->back()->with('success', 'Upload Metode Pembayaran berhasil');
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
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), ["image" => 'required']);
        if ($validator->fails()) {
            return response()->json([
                "status" => 0,
                "message" => "gagal",
                "location" => null
            ], 400);
        }
        $files = $request->file('image');
        $destinationPath = 'public/images/paymen-method/'; // upload path
        $imageName = date('YmdHis') . "." . $files->getClientOriginalExtension();
        // $ikan['image'] = "$imageName";
        $files->move($destinationPath, $imageName);

        $forDB = $destinationPath . $imageName;
        return response()->json([
            "status" => 1,
            "message" => "sukses",
            "location" => $forDB
        ], 201);
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

        $saldo = PaymentMethod::find($id);
        $saldo->update([
            'name' => $request->get('name'),
            'image' => $request->get('image'),
        ]);

        return response()->json(['status' => 1, 'message' => 'success']);
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
