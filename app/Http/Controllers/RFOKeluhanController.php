<?php

namespace App\Http\Controllers;
use DateTime;
use App\Models\RFO_Keluhan;
use Illuminate\Http\Request;

class RFOKeluhanController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Load data RFO Keluhan successfully',
            'data' => RFO_Keluhan::with('user','user.role','user.pop','keluhan')->get()], 200);
    }

    public function store(Request $request)
    {
        $message = 'RFO Keluhan created successfully';
        $status = "success";

        $user_id = $request->input('user_id');
        $keluhan_id = $request->input('keluhan_id');
        $nomor_tiket = $request->input('nomor_tiket');
        $mulai_keluhan = $request->input('mulai_keluhan');
        $selesai_keluhan = $request->input('selesai_keluhan');
        $start = new DateTime($mulai_keluhan);//start time
        $end = new DateTime($selesai_keluhan);//end time
        $durasi = $start->diff($end);
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
                'durasi' => $durasi->format("%d Hari - %h Jam - %i Menit"),
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

    public function show($id)
    {
        $message = "Load data post successfully";
        $status = "success";
        $rfo_keluhan = RFO_Keluhan::find($id);
        

        if (!$rfo_keluhan) {
            $status = "error";
            $message = "Data RFO not found";
        }

        $rfo_keluhan->user;
        $rfo_keluhan->user->role;
        $rfo_keluhan->user->pop;
        $rfo_keluhan->keluhan;
        $rfo_keluhan->keluhan->user;
        $rfo_keluhan->keluhan->user->role;
        $rfo_keluhan->keluhan->user->pop;
        $rfo_keluhan->keluhan->balasan;
        // Relasi ini kayaknya masih belum bener
        // $rfo_keluhan->keluhan->balasan->user;
        // $rfo_keluhan->keluhan->balasan->pop;
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $rfo_keluhan], 200);
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

        $start = new DateTime($request->mulai_keluhan);//start time
        $end = new DateTime($request->selesai_keluhan);//end time
        $durasi = $start->diff($end);

        try {
            RFO_Keluhan::find($id)->update([
                'user_id' => $request->user_id,
                'keluhan_id' => $request->keluhan_id,
                'nomor_tiket' => $request->nomor_tiket,
                'mulai_keluhan' => $request->mulai_keluhan,
                'selesai_keluhan' => $request->selesai_keluhan,
                'durasi' => $durasi->format("%d Hari - %h Jam - %i Menit"),
                'problem' => $request->problem,
                'action' => $request->action,
                'status' => $request->status,
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
