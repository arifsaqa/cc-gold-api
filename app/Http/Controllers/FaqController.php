<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Carbon\Carbon;
use CreateFaqsTable;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs =  Faq::all();
        if (!$faqs->first()) {
            return response()->json([
                'status' => 0,
                'message' => 'data faq masih kosong',
                'data' => 'Belum ada data'
            ]);
        }
        return response()->json([
            'status' => 1,
            'message' => 'berhasil mendapatkan data',
            'data'  => $faqs
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
                'question' => 'required|string',
                'answer' => 'required|string'
            ]);
            Faq::create([
               'question' => $request->question,
               'answer' => $request->answer,
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now()
            ]);
            return redirect()->back()->with('success', 'Data faq sudah tersimpan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th);
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
        $faq = Faq::find($id);

        return response()->json([
            'status' => 1,
            'data' => $faq
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
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);
        $faq = Faq::find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $savedData = $faq->save();

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
        $faq = Faq::find($id);
        $deleteData = $faq->delete();

        if ($deleteData) {
            return redirect()->back()->with('success', 'Berhasil hapus data');
        }
    }
}
