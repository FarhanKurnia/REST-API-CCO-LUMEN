<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use App\Models\Keluhan;
use DateTime;
use App\Models\Laporan;
use App\Models\RFO_Gangguan;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    public function userLaporan()
    {
        $token = JWTAuth::getToken();
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $pop_id = $id_jwt['pop_id'];

        $message = "Data User Helpdesk dan NOC berhasil ditemukan";
        $status = "success";
        $helpdesk = User::where([
            ['pop_id',$pop_id],
            ['role_id',1],
            ])->get();
        $noc = User::where([
            ['pop_id',$pop_id],
            ['role_id',2],
            ])->get();
        if (!$helpdesk) {
            $status = "success";
            $message = "Data User Helpdesk tidak ditemukan dan data User NOC ditemukan";
            return response()->json([
                'status' => $status,
                'message' => $message,
                'user' => [
                    'noc' => $noc,
                ]
            ], 200);
        }elseif(!$noc){
            $status = "success";
            $message = "Data User NOC tidak ditemukan dan data User Helpdesk ditemukan";
            return response()->json([
                'status' => $status,
                'message' => $message,
                'user' => [
                    'helpdesk' => $helpdesk,
                ]
            ], 200);
        }
        else{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'user' => [
                    'helpdesk' => $helpdesk,
                    'noc' => $noc,
                ]
            ], 200);
        }
    }

    // Fungsi untuk get keluhan laporan dengan request: tanggal, mulai dan selesai
    public function keluhanLaporan(Request $request){
        $tanggal1 = $request->input('tanggal');
        $tanggal2 = '';
        $shift = $request->input('shift');
        $mulai = '';
        $selesai = '';
        $pop_id = $request->input('pop_id');
        if($shift == 1){
            $tanggal2 = $tanggal1;
            $t1=mktime(8, 00, 00, 0, 0, 0);
            $t2=mktime(16, 30, 00, 0, 0, 0);
            $mulai = date('H:i:s',$t1);
            $selesai = date('H:i:s',$t2);
        }elseif($shift == 2){
            $ymd = DateTime::createFromFormat('Y-m-d', $tanggal1);
            $y2 = $ymd->format('Y');
            $m2 = $ymd->format('m');
            $d2 = $ymd->format('d');
            $d2++;
            $t1=mktime(16, 30, 00, 0, 0, 0);
            $t2=mktime(00, 30, 00, $m2, $d2, $y2);
            $mulai = date('H:i:s',$t1);
            $selesai = date('H:i:s',$t2);
            $tanggal2 = date('Y-m-d',$t2);
        }
        $total_keluhan = Keluhan::where('pop_id',$pop_id)->whereBetween('created_at', [$tanggal1.' '.$mulai, $tanggal2.' '.$selesai])->count();
        $keluhan = Keluhan::with('pop','rfo_keluhan')->where('pop_id',$pop_id)->whereBetween('created_at', [$tanggal1.' '.$mulai, $tanggal2.' '.$selesai])->get();
        $total_rfo_gangguan = RFO_Gangguan::with('keluhan')->whereBetween('created_at', [$tanggal1.' '.$mulai, $tanggal2.' '.$selesai])->count();
        $rfo_gangguan = RFO_Gangguan::with('keluhan')->whereBetween('created_at', [$tanggal1.' '.$mulai, $tanggal2.' '.$selesai])->get();

        if($keluhan->isEmpty()){
            return response()->json([
                'status' => 'error',
                'message' => 'Data keluhan tidak ditemukan',
            ], 404);
        }else{
            return response()->json([
                'status' => 'succes',
                'message' => 'Data keluhan berhasil ditemukan',
                'data' => [
                    'total_keluhan'=> $total_keluhan,
                    'keluhan'=>$keluhan,
                    'total_rfo_gangguan'=> $total_rfo_gangguan,
                    'rfo_gangguan' => $rfo_gangguan,
                ]
            ], 200);
        }
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
