<?php

namespace App\Http\Controllers;

use App\Models\Lampiran_Balasan;
use Illuminate\Http\Request;

class LampiranBalasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Load data Lampiran successfully',
            'data' => Lampiran_Balasan::get()], 200);
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
        $message = "Lampiran berhasil ditambahkan";
        $status = "success";
        $this->validate($request, [
                'path.*' => 'mimes:doc,pdf,docx,zip,jpeg,jpg,png,mp4|max:5000'
        ]);
        try {
            $balasan_id = $request->input('balasan_id');
            $paths = $request->file('path');
            foreach($paths as $path){
                $new_name = date("Ymd").rand(100,999).'_attachment_balasan'.'.'.$path->getClientOriginalExtension();
                $path->move('lampiran',$new_name);
                $lampiranbalasan= new Lampiran_Balasan();
                $lampiranbalasan->path = url('lampiran'.'/'.$new_name);
                $lampiranbalasan->balasan_id = $balasan_id;
                $lampiranbalasan->save();
            }
        }catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lampiran_Balasan  $lampiran_Balasan
     * @return \Illuminate\Http\Response
     */
    public function show(Lampiran_Balasan $lampiran_Balasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lampiran_Balasan  $lampiran_Balasan
     * @return \Illuminate\Http\Response
     */
    public function edit(Lampiran_Balasan $lampiran_Balasan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lampiran_Balasan  $lampiran_Balasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lampiran_Balasan $lampiran_Balasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lampiran_Balasan  $lampiran_Balasan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lampiran_Balasan $lampiran_Balasan)
    {
        //
    }
}
