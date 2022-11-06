<?php

namespace App\Http\Controllers;

use App\Models\Lampiran_Keluhan;
use Illuminate\Http\Request;

class LampiranKeluhanController extends Controller
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
            'data' => Lampiran_Keluhan::get()], 200);
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
            $keluhan_id = $request->input('keluhan_id');
            $paths = $request->file('path');
            foreach($paths as $path){
                $new_name = date("Ymd").rand(100,999).'_attachment_keluhan'.'.'.$path->getClientOriginalExtension();
                $path->move('lampiran',$new_name);
                $lampirankeluhan= new Lampiran_Keluhan();
                $lampirankeluhan->path = url('lampiran'.'/'.$new_name);
                $lampirankeluhan->keluhan_id = $keluhan_id;
                $lampirankeluhan->save();
            }
        }catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
        // 1 file
        // $path = $request->file('path');
        // if($request->hasFile('path')){
        //     $new_name = rand().'.'.$path->getClientOriginalExtension();
        //     $path->move('lampirankeluhan',$new_name);
        //     return response()->json($new_name);


        // }else{
        //     return response()->json('Image Null');
        // }
        // $lampirankeluhan[5]= new Lampiran_Keluhan();
        // $test = $lampirankeluhan[5];
        // dd($test);
        // // $request->validate([
        // //     'filename' => 'required',
        // //     'filename.*' => 'mimes:doc,docx,PDF,pdf,jpg,jpeg,png|max:2000'
        // // ]);
        // if ($request->hasfile('path')) {
        //     $files = [];
        //     foreach ($request->file('path') as $file) {
        //         if ($file->isValid()) {
        //             $pathName = time().'_attachment'.'.'.$file->getClientOriginalExtension();
        //             $path->move('lampirankeluhan', $pathName);
        //             $files[] = [
        //                 'path' => url('lampirankeluhan'.'/'.$pathName),
        //             ];
        //         }
        //     }
        //     Lampiran_Keluhan::insert($files);
        //     echo'Success';
        // }else{
        //     echo'Gagal';
        // }

        // $this->validate($request, [
        //     'filenames' => 'required',
        //     'filenames.*' => 'mimes:doc,pdf,docx,zip'
        // ]);
        // Upload 1 file
        // $lampirankeluhan= new Lampiran_Keluhan();
        // $pathName = time().'_attachment'.'.'.request()->path->getClientOriginalExtension();
        // $request->path->move('lampirankeluhan',$pathName);
        // $lampirankeluhan->path = url('lampirankeluhan'.'/'.$pathName);
        // $lampirankeluhan->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lampiran_Keluhan  $lampiran_Keluhan
     * @return \Illuminate\Http\Response
     */
    public function show(Lampiran_Keluhan $lampiran_Keluhan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lampiran_Keluhan  $lampiran_Keluhan
     * @return \Illuminate\Http\Response
     */
    public function edit(Lampiran_Keluhan $lampiran_Keluhan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lampiran_Keluhan  $lampiran_Keluhan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lampiran_Keluhan $lampiran_Keluhan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lampiran_Keluhan  $lampiran_Keluhan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lampiran_Keluhan $lampiran_Keluhan)
    {
        //
    }
}
