<?php

namespace App\Http\Controllers;
use DateTime;
use App\Models\RFO_Gangguan;
use Illuminate\Http\Request;

class RFOGangguanController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data RFO Gangguan berhasil dimuat',
            'data' => RFO_Gangguan::with('user')->get()], 200);
    }

    public function store(Request $request)
    {
        $message = 'Data RFO Gangguan berhasil dibuat';
        $status = "success";
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
        $start = new DateTime($mulai_gangguan);//start time
        $end = new DateTime($selesai_gangguan);//end time
        $durasi = $start->diff($end);
        $problem = $request->input('problem');
        $action = $request->input('action');
        $status_RFO = $request->input('status');
        $deskripsi = $request->input('deskripsi');
        $lampiran_rfo_gangguan = $request->input('lampiran_rfo_gangguan');

        try {
            RFO_Gangguan::create([
                'user_id' => $user_id,
                'nomor_tiket' => $nomor_tiket,
                'mulai_gangguan' => $mulai_gangguan,
                'selesai_gangguan' => $selesai_gangguan,
                'problem' => $problem,
                'durasi' => $durasi->format("%d Hari - %h Jam - %i Menit"),
                'action' => $action,
                'status' => $status_RFO,
                'deskripsi' => $deskripsi,
                'nomor_rfo_gangguan' => $nomor_rfo_gangguan,
                'lampiran_rfo_gangguan' => $lampiran_rfo_gangguan,
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
     * @param  \App\Models\RFO_Gangguan  $rFOGangguan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = "Data RFO Gangguan berhasil dimuat";
        $status = "success";
        $rfo_gangguan = RFO_Gangguan::find($id);

        if (!$rfo_gangguan) {
            $status = "error";
            $message = "Data RFO Gangguan tidak ditemukan";
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }else{
            $rfo_gangguan->user;
            $rfo_gangguan->keluhan;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $rfo_gangguan], 200);
        }
    }

    public function update(Request $request, $id)
    {
        $message = 'Data updated successfully';
        $status = "success";

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
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    public function search(Request $request)
	{
        $keyword = $request->get('keyword');
        // Fungsi ini berhasil namun pencarian terbatas hanya Nama Pelanggan
        // $data = Keluhan::where('status','closed')
        // ->where('nama_pelanggan', 'iLIKE', "%{$search}%")
        // ->orWhere('nomor_pelapor', 'iLIKE', "%{$search}%")
        // ->get();

        // Fungsi ini berhasil melakukan pencarian lengkap yang statusnya closed
        $data = RFO_Gangguan::where(
            'nomor_rfo_gangguan', $keyword)->orwhere('problem', 'iLIKE', "%{$keyword}%")->orwhere('nomor_tiket', $keyword)->paginate(10);

        if($data->isEmpty()){
            return response()->json([
                'status' => 'error',
                'message' => 'Data history keluhan tidak ditemukan',
            ], 404);
        }else{
            return response()->json([
                'status' => 'succes',
                'message' => 'Data history keluhan berhasil ditemukan',
                'data' => $data
            ], 200);
        }
    }

    public function destroy($id)
    {
        $message = 'Data RFO Gangguan berhasil dihapus';
        $status = "success";
        try {
            RFO_Gangguan::find($id)->delete();
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }
}
