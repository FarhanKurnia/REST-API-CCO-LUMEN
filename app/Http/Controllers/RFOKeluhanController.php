<?php

namespace App\Http\Controllers;
use DateTime;
use App\Models\RFO_Keluhan;
use Illuminate\Http\Request;
use Carbon\Carbon;


class RFOKeluhanController extends Controller
{
    // Index function to get All RFO Keluhan
    public function index()
    {
        $rfo_keluhan = RFO_Keluhan::where('deleted_at',null)->with('user','user.role','user.pop','keluhan')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Load data RFO Keluhan successfully',
            'data' => $rfo_keluhan], 200);
    }

    // Store RFO Keluhan function
    public function store(Request $request)
    {
        // Format:
        // #RFO-S051102212345
        // # = hashtag
        // T = Trouble
        // date() = YYYY-MM-DD
        // Random Interger = 5 Digit

        $user_id = $request->input('user_id');
        $nomor_tiket = $request->input('nomor_tiket');
        $nomor_rfo_keluhan = '#RFO-S'.date("Ymd").rand( 10000 , 99999 );
        $mulai_keluhan = $request->input('mulai_keluhan');
        $selesai_keluhan = $request->input('selesai_keluhan');
        $start = new DateTime($mulai_keluhan);//start time
        $end = new DateTime($selesai_keluhan);//end time
        $durasi = $start->diff($end);
        $problem = $request->input('problem');
        $action = $request->input('action');
        $deskripsi = $request->input('deskripsi');

        try {
            $RFO_Keluhan = RFO_Keluhan::create([
                'user_id' => $user_id,
                // 'keluhan_id' => $keluhan_id,
                'nomor_tiket' => $nomor_tiket,
                'nomor_rfo_keluhan' => $nomor_rfo_keluhan,
                'mulai_keluhan' => $mulai_keluhan,
                'selesai_keluhan' => $selesai_keluhan,
                'problem' => $problem,
                'durasi' => $durasi->format("%d Hari - %h Jam - %i Menit"),
                'action' => $action,
                'deskripsi' => $deskripsi,
            ]);
            $message = 'Data RFO Keluhan added successfully';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            $http_code = 404;
        }
        $RFO_Keluhan_id = $RFO_Keluhan->id_rfo_keluhan;
        // dd($RFO_Keluhan_id);
        return response([
            'status' => $status,
            'message' => $message,
            'id_rfo_keluhan' => $RFO_Keluhan_id
        ], $http_code);
    }

    // Show detail RFO Gangguan function
    public function show($id)
    {
        $rfo_keluhan = RFO_Keluhan::find($id);
        if (!$rfo_keluhan) {
            $status = 'Error';
            $message = 'Data RFO Gangguan not found';
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }else{
            $rfo_keluhan->user;
            $rfo_keluhan->user->role;
            $rfo_keluhan->user->pop;
            $rfo_keluhan->keluhan;
            $rfo_keluhan->keluhan->user;
            $rfo_keluhan->keluhan->user->role;
            $rfo_keluhan->keluhan->user->pop;
            $rfo_keluhan->keluhan->balasan;
            $message = 'Data RFO Gangguan has found';
            $status = 'Success';
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $rfo_keluhan], 200);
        }
    }

    // Update RFO Keluhan function
    public function update(Request $request, $id)
    {
        $start = new DateTime($request->mulai_keluhan);//start time
        $end = new DateTime($request->selesai_keluhan);//end time
        $durasi = $start->diff($end);

        try {
            RFO_Keluhan::find($id)->update([
                'user_id' => $request->user_id,
                // 'keluhan_id' => $request->keluhan_id,
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
            $message = 'Data RFO keluhan updated successfully';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            $http_code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }

    // Delete RFO Gangguan function
    public function destroy($id)
    {
        try {
            RFO_Keluhan::find($id)->update([
                'deleted_at' => Carbon::now()]
            );
            $message = 'RFO Keluhan deleted successfully';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            $http_code = 404;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }
}
