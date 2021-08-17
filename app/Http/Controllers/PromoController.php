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
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string', 
            'description' => 'required|string',
            'image'=> 'required|string']);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $promo = Promo::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'image' =>  $request->get('image'),
        ]);

        return response()->json([
            'data' => $promo, 
            'status' => 1, 
            'message' => 'sukses'], 201);

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
        $title = $request->title;
        $image = $request->image;
        $description = $request->description;

        $promo = Promo::find($id)->first();
        $promo->title = $title;
        $promo->image = $image;
        $promo->description = $description;
        $promo->save();

        return response()->json([
            "status" => 1,
            "message" => "sukses",
        ], 201);

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

    public function destroy($id)
    {
        $promo = Promo::find($id)->first();
        $file = $promo->image;
        $deleteImage= File::delete($file);
        $deleteData = $promo->delete();

        if($deleteImage && $deleteData){
            return response()->json([
                "status" => 1,
                "message" => "sukses",
            ], 200); 
        }else{
            return response()->json([
                "status" => 0,
                "message" => "gagal",
            ], 200); 
        }

    }

}
