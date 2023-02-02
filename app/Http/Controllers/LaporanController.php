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
    // Index function for get all report
    public function index(Request $request)
    {
        $pop_id = $request->get('pop_id');
        $keyword = $request->get('keyword');
        if($pop_id == null && $keyword == null){
            $laporan = Laporan::where('deleted_at',null)->with('user','pop','shift')->orderBy('created_at', 'DESC')->paginate(10);
        }else if(!empty($pop_id) && $keyword == null){
            $laporan = Laporan::where([
                ['pop_id',$pop_id],
                ['deleted_at',null]
                ])->with('user','pop','shift')->orderBy('created_at', 'DESC')->paginate(10);
        }else if(!empty($keyword) && $pop_id == null ){
            $laporan = Laporan::where([
                ['tanggal', $keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['nomor_laporan', $keyword],
                ['deleted_at',null]
            ])->with('user','pop','shift')->orderBy('created_at', 'DESC')->paginate(10);
        }else if(!empty($pop_id) && !empty($keyword)){
            $laporan = Laporan::where([
                ['pop_id',$pop_id],
                ['tanggal', $keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['pop_id',$pop_id],
                ['nomor_laporan', $keyword],
                ['deleted_at',null]
            ])->with('user','pop','shift')->orderBy('created_at', 'DESC')->paginate(10);
        }else{
            return response()->json([
                'status'=> "Error",
                'message' => 'Invalid Request',
            ],404);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Load data Lampiran successfully',
            'data' => $laporan], 200);
    }

    // Store daily report function
    public function store(Request $request)
    {
        $this->validate($request, [
            'lampiran_laporan.*' => 'mimes:doc,pdf,docx|max:5000'
        ]);
        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $id_user = $jwt_id['id_user'];

        $tanggal = $request->input('tanggal');
        $shift_id = $request->input('shift_id');
        $pop_id = $request->input('pop_id');
        $noc = $request->input('noc');
        $helpdesk = $request->input('helpdesk');
        // Request 1 file for attachment
        $lampiran_laporan = $request->file('lampiran_laporan');
        if($request->hasFile('lampiran_laporan')){
            $nomor_laporan = 'REF-ID-'.date('Ymd').$pop_id.$shift_id.rand( 100 , 999 );
            $new_name = $nomor_laporan.'.'.$lampiran_laporan->getClientOriginalExtension();
            $lampiran_laporan->move('laporan',$new_name);
            try {
                Laporan::create([
                    'nomor_laporan' => $nomor_laporan,
                    'tanggal' => $tanggal,
                    'shift_id' => $shift_id,
                    'pop_id' => $pop_id,
                    'noc' => $noc,
                    'helpdesk' => $helpdesk,
                    'user_id' => $id_user,
                    'lampiran_laporan' => url('laporan'.'/'.$new_name),
                ]);
                $message = 'Report added successfully';
                $status = 'Success';
                $http_code = 200;
            } catch (\Throwable $th) {
                $status = 'Error';
                $message = $th->getMessage();
                $http_code = 404;
            }
        }else{
            $message = 'Please add report attachment';
            $status = 'Error';
            $http_code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ],$http_code);
    }

    // Show detail report function
    public function show($id)
    {
        $laporan = Laporan::find($id);
        if (!$laporan) {
            $status = 'Error';
            $message = 'Report not found';
            $http_code = 404;
        }else{
            $laporan->shift;
            $laporan->user;
            $laporan->role;
            $laporan->pop;
            $status = 'Success';
            $message = 'Report found';
            $http_code = 200;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $laporan
        ],$http_code);
    }

    // Search Laporan 
    public function search(Request $request)
	{
        $pop_id = $request->get('pop_id');
        $keyword = $request->get('keyword');
        if ($pop_id == null) {
            $data = Laporan::where([
                    ['tanggal', $keyword],
                    ['deleted_at',null]
                ])->get();
            if($data->isEmpty()){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data Laporan not found',
                ], 404);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data Laporan has found',
                    'data' => $data
                ], 200);
            }
        }else{
            $data = Laporan::where([
                ['tanggal', $keyword],
                ['deleted_at',null],
                ['pop_id',$pop_id]
            ])->paginate(10);

            if($data->isEmpty()){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data Laporan not found',
                ], 404);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data Laporan has found',
                    'data' => $data
                ], 200);
            }
        }
    }       
    
    // Get all user for input daily report
    public function userLaporan()
    {
        $token = JWTAuth::getToken();
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $pop_id = $id_jwt['pop_id'];

        $helpdesk = User::where([
            ['pop_id',$pop_id],
            ['role_id',1],
            ])->get();
        $noc = User::where([
            ['pop_id',$pop_id],
            ['role_id',2],
            ])->get();
        if (!$helpdesk) {
            $status = 'Success';
            $message = 'Data User Helpdesk not found and data User NOC has been found';
            return response()->json([
                'status' => $status,
                'message' => $message,
                'user' => [
                    'noc' => $noc,
                ]
            ], 200);
        }elseif(!$noc){
            $status = 'Success';
            $message = 'Data User NOC not found and data User Helpdesk has been found';
            return response()->json([
                'status' => $status,
                'message' => $message,
                'user' => [
                    'helpdesk' => $helpdesk,
                ]
            ], 200);
        }
        else{
            $message = 'Data User Helpdesk and NOC has been found';
            $status = 'Success';
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

    // Get Keluhan for daily report with request: date, shift and pop
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
        }elseif($shift == 3){
            $ymd = DateTime::createFromFormat('Y-m-d', $tanggal1);
            $y2 = $ymd->format('Y');
            $m2 = $ymd->format('m');
            $d2 = $ymd->format('d');
            $d2++;
            $t1=mktime(00, 30, 00, 0, 0, 0);
            $t2=mktime(8, 30, 00, $m2, $d2, $y2);
            $mulai = date('H:i:s',$t1);
            $selesai = date('H:i:s',$t2);
            $tanggal2 = date('Y-m-d',$t2);
        }
        $total_keluhan_open = Keluhan::where([['pop_id',$pop_id],['status','open']])->whereBetween('created_at', [$tanggal1.' '.$mulai, $tanggal2.' '.$selesai])->count();
        $total_keluhan_closed = Keluhan::where([['pop_id',$pop_id],['status','closed']])->whereBetween('created_at', [$tanggal1.' '.$mulai, $tanggal2.' '.$selesai])->count();
        $keluhan = Keluhan::with('pop','rfo_keluhan')->where('pop_id',$pop_id)->whereBetween('created_at', [$tanggal1.' '.$mulai, $tanggal2.' '.$selesai])->get();
        $keluhan_open = Keluhan::where([['pop_id',$pop_id],['status','open']])->whereBetween('created_at', [$tanggal1.' '.$mulai, $tanggal2.' '.$selesai])->get();
        $keluhan_close = Keluhan::where([['pop_id',$pop_id],['status','closed']])->whereBetween('created_at', [$tanggal1.' '.$mulai, $tanggal2.' '.$selesai])->get();
        $total_rfo_gangguan = RFO_Gangguan::with('keluhan')->whereBetween('created_at', [$tanggal1.' '.$mulai, $tanggal2.' '.$selesai])->count();
        $rfo_gangguan = RFO_Gangguan::whereBetween('created_at', [$tanggal1.' '.$mulai, $tanggal2.' '.$selesai])->get();

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
                    'total_keluhan_open'=> $total_keluhan_open,
                    'total_keluhan_closed'=> $total_keluhan_closed,
                    'total_rfo_gangguan'=> $total_rfo_gangguan,
                    'keluhan_open'=>$keluhan_open,
                    'keluhan_close'=>$keluhan_close,
                    'rfo_gangguan' => $rfo_gangguan,
                ]
            ], 200);
        }
    }

    // Delete Laporan function
    public function destroy($id)
    {
        try {
            Laporan::find($id)->update([
                'deleted_at' => Carbon::now()]
            );
            $message = 'Report deleted successfully';
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
