<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
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
            'data' => Laporan::with('user','pop','shift')->orderBy('created_at', 'DESC')->get()], 200);
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
        $this->validate($request, [
            'lampiran_laporan.*' => 'mimes:doc,pdf,docx|max:5000'
        ]);
        $message = 'Laporan berhasil dimasukan';
        $status = "success";
        $tanggal = $request->input('tanggal');
        $shift_id = $request->input('shift_id');
        $pop_id = $request->input('pop_id');
        $petugas = $request->input('petugas');
        $user_id = $request->input('user_id');
        // 1 file
        $lampiran_lamporan = $request->file('lampiran_lamporan');
        if($request->hasFile('lampiran_lamporan')){
            $nomor_laporan = 'REF-ID-'.date('Ymd').$pop_id.$shift_id.rand( 100 , 999 );
            $new_name = $nomor_laporan.'.'.$lampiran_lamporan->getClientOriginalExtension();
            $lampiran_lamporan->move('laporan',$new_name);
            try {
                Laporan::create([
                    'nomor_laporan' => $nomor_laporan,
                    'tanggal' => $tanggal,
                    'shift_id' => $shift_id,
                    'pop_id' => $pop_id,
                    'petugas' => $petugas,
                    'user_id' => $user_id,
                    'lampiran_laporan' => url('laporan'.'/'.$new_name),
                ]);
            } catch (\Throwable $th) {
                $status = "error";
                $message = $th->getMessage();
            }
            return response([
                'status' => $status,
                'message' => $message,
            ], 200);
        }else{
            return response([
                'status' => 'error',
                'message' => 'harap sertakan attachment laporan',
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = "Laporan ditemukan";
        $status = "success";
        $laporan = Laporan::find($id);
        if (!$laporan) {
            $status = "error";
            $message = "Laporan tidak ditemukan";
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }else{
            $laporan->user;
            $laporan->role;
            $laporan->pop;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' =>$laporan
            ],200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laporan $laporan)
    {
        //
    }
}
