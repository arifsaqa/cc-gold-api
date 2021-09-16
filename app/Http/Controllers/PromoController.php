<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('promos')->orderBy('created_at', 'desc')->limit(5)->get();

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
    public function add(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'discount' => 'required|integer',
            'type' => 'required|integer',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/promo'), $imageName);
        Promo::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'discount' => $request->get('discount'),
            'type' => $request->get('type'),
            'image' =>  asset('images/promo/'.$imageName),
        ]);

        return redirect()->back()->with('success', 'Upload Promo berhasil');

    }
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $promo = Promo::find($id);
        $userList = json_decode($promo->userList);
        if ($userList == null) {
            $promo->userList = json_encode([$request->userId]);
        }else{
            foreach ($userList as $value) {
                if ($value == $request->userId) {
                    return response()->json([
                        'status' => 0,
                        'message' => "User sudah menggunakan promo ini"
                    ]);
                }
            }
            array_push($userList, $request->userId);
            $promo->update(['userList' => $userList]);
        }
        $promo->save();
        return response()->json([
            'status'=> 1,
            'data'=>$promo,
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
        $promo = Promo::find($id);

        return response()->json([
            'status'=> 1,
            'data'=>$promo,
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
            'title' => 'required',
            'description' => 'required',
        ]);

        $promo = Promo::find($id);

        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/promo'), $imageName);
            $promo->image = asset('images/promo/'.$imageName);
        }

        $promo->title = $request->title;
        $promo->description = $request->description;
        $promo->save();

        return redirect()->back()->with('success', 'Berhasil edit data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request){

        if ($files = $request->file('image')) {
            $destinationPath = 'public/images/promo/'; // upload path
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

    }

    public function destroy($promo)
    {
        $promo = Promo::find($promo)->first();
        $file = $promo->image;
        $file = explode(asset('/'), $file);
        $deleteImage= File::delete($file[1]);

        if($deleteImage){
            $deleteData = $promo->delete();
            if ($deleteData) {
                return redirect()->back()->with('success', 'Berhasil hapus data');
            }
            else{
                return redirect()->back()->with('error', 'Gagal hapus data');
            }
        }else{
            return redirect()->back()->with('error', 'Gagal hapus gambar');
        }

    }

}
