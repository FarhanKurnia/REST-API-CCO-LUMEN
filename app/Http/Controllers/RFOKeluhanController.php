<?php

namespace App\Http\Controllers;

use App\Models\RFO_Keluhan;
use Illuminate\Http\Request;

class RFOKeluhanController extends Controller
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
            'message' => 'Load data RFO Keluhan successfully',
            'data' => RFO_Keluhan::all()], 200);
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
        $message = 'RFO Keluhan created successfully';
        $status = "success";

        $user_id = $request->input('user_id');
        $keluhan_id = $request->input('keluhan_id');
        $nomor_tiket = $request->input('nomor_tiket');
        $mulai_keluhan = $request->input('mulai_keluhan');
        $selesai_keluhan = $request->input('selesai_keluhan');
        $problem = $request->input('problem');
        $action = $request->input('action');
        $status_RFO = $request->input('status');
        $deskripsi = $request->input('deskripsi');
        $lampiran_rfo_keluhan = $request->input('lampiran_rfo_keluhan');

        try {
            RFO_Keluhan::create([
                'user_id' => $user_id,
                'keluhan_id' => $keluhan_id,
                'nomor_tiket' => $nomor_tiket,
                'mulai_keluhan' => $mulai_keluhan,
                'selesai_keluhan' => $selesai_keluhan,
                'problem' => $problem,
                'action' => $action,
                'status' => $status_RFO,
                'deskripsi' => $deskripsi,
                'lampiran_rfo_keluhan' => $lampiran_rfo_keluhan,
            ]);
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }

        return response([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RFO_Keluhan  $rFO_Keluhan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = "Load data post successfully";
        $status = "success";
        $rfo_keluhan = RFO_Keluhan::find($id);

        if (!$rfo_keluhan) {
            $status = "error";
            $message = "Data keluhan not found";
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $rfo_keluhan::with('user','keluhan')->where('id',$id)->get()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RFO_Keluhan  $rFO_Keluhan
     * @return \Illuminate\Http\Response
     */
    public function edit(RFO_Keluhan $rFO_Keluhan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RFO_Keluhan  $rFO_Keluhan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = 'Data updated successfully';
        $status = "success";

        try {
            Bts::find($id)->update([
                'user_id' => $request->user_id,
                'keluhan_id' => $request->keluhan_id,
                'nomor_tiket' => $request->nomor_tiket,
                'mulai_keluhan' => $request->mulai_keluhan,
                'selesai_keluhan' => $request->selesai_keluhan,
                'problem' => $request->problem,
                'action' => $request->action,
                'status' => $request->status_RFO,
                'deskripsi' => $request->deskripsi,
                'lampiran_rfo_keluhan' => $request->lampiran_rfo_keluhan,
            ]);
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RFO_Keluhan  $rFO_Keluhan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RFO_Keluhan $rFO_Keluhan)
    {
        //
    }
}
