<?php

namespace App\Http\Controllers;
use DateTime;
use App\Models\RFO_Gangguan;
use Illuminate\Http\Request;
use Carbon\Carbon;


class RFOGangguanController extends Controller
{
    // Index function to get All RFO Gangguan
    public function index()
    {
        $rfo_gangguan = RFO_Gangguan::where('deleted_at',false)->with('user')->get();
        return response()->json([
            'status' => 'Success',
            'message' => 'Load Data RFO Gangguan succesfully',
            'data' => $rfo_gangguan], 200);
    }

    // Store RFO Gangguan function
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
        $nomor_rfo_gangguan = '#RFO-G'.date("Ymd").rand( 100 , 999 );
        $mulai_gangguan = $request->input('mulai_gangguan');
        $selesai_gangguan = $request->input('selesai_gangguan');
        // $start = new DateTime($mulai_gangguan);//start time
        // $end = new DateTime($selesai_gangguan);//end time
        // $durasi = $start->diff($end);
        $problem = $request->input('problem');
        $action = $request->input('action');
        $status_RFO = $request->input('status');
        $deskripsi = $request->input('deskripsi');

        try {
            RFO_Gangguan::create([
                'user_id' => $user_id,
                'nomor_tiket' => $nomor_tiket,
                'mulai_gangguan' => $mulai_gangguan,
                'selesai_gangguan' => $selesai_gangguan,
                'problem' => $problem,
                // 'durasi' => $durasi->format("%d Hari - %h Jam - %i Menit"),
                'action' => $action,
                'status' => $status_RFO,
                'deskripsi' => $deskripsi,
                'nomor_rfo_gangguan' => $nomor_rfo_gangguan,
            ]);
            $message = 'Data RFO Gangguan berhasil dibuat';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            $http_code = 404;
        }

        return response([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }

    // Close RFO (Reason For Outage) Gangguan function if there is internet connection interruption
    public function close(Request $request, $id)
    {
        $selesai_gangguan = $request->input('selesai_gangguan');
        // $start = new DateTime($mulai_gangguan);//start time
        // $end = new DateTime($selesai_gangguan);//end time
        // $durasi = $start->diff($end);

        try {
            RFO_Gangguan::find($id)->update([
                'status' => $request->status='closed',
                'selesai_gangguan' => $selesai_gangguan,
            ]);
            $message = 'RFO Gangguan closed successfully';
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

    // Show detail RFO Gangguan function
    public function show($id)
    {
        $rfo_gangguan = RFO_Gangguan::find($id);
        if (!$rfo_gangguan) {
            $status = 'Error';
            $message = 'Show detail RFO Gangguan failed';
            $http_code = 404;
            return response()->json([
                'status' => $status,
                'message' => $message], $http_code);
        }else{
            $rfo_gangguan->user;
            $rfo_gangguan->keluhan;
            $message = 'Show detail RFO Gangguan successfully';
            $status = 'Success';
            $http_code = 200;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $rfo_gangguan], $http_code);
        }
    }

    // Update RFO Gangguan function
    public function update(Request $request, $id)
    {
        $start = new DateTime($request->mulai_gangguan);//start time
        $end = new DateTime($request->selesai_gangguan);//end time
        $durasi = $start->diff($end);

        try {
            RFO_Gangguan::find($id)->update([
                'user_id' => $request->user_id,
                'nomor_tiket' => $request->nomor_tiket,
                'mulai_gangguan' => $request->mulai_gangguan,
                'selesai_gangguan' => $request->mulai_gangguan,
                'durasi' => $durasi->format("%d Hari - %h Jam - %i Menit"),
                'problem' => $request->problem,
                'action' => $request->action,
                'status' => $request->status,
                'deskripsi' => $request->deskripsi,
                'lampiran_rfo_gangguan' => $request->lampiran_rfo_gangguan,
            ]);
            $message = 'Data updated successfully';
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

    // Update RFO Gangguan function with keeyword and closed status
    public function search(Request $request)
	{
        $keyword = $request->get('keyword');
        $data = RFO_Gangguan::where(
            'nomor_rfo_gangguan', $keyword)->orwhere('problem', 'iLIKE', "%{$keyword}%")->orwhere('nomor_tiket', $keyword)->paginate(10);

        if($data->isEmpty()){
            $message = 'Data history keluhan not found';
            $status = 'Error';
            $http_code = 404;
            return response()->json([
                'status' => $status,
                'message' => $message,
            ], $http_code);
        }else{
            $message = 'Data history keluhan has found';
            $status = 'Success';
            $http_code = 404;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $http_code);
        }
    }

    // Delete RFO Gangguan function
    public function destroy($id)
    {
        try {
            RFO_Gangguan::find($id)->update([
                'deleted_at' => Carbon::now()]
            );
            $message = 'RFO Gangguan deleted successfully';
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
