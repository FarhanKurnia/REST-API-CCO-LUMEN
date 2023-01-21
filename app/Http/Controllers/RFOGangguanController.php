<?php

namespace App\Http\Controllers;
use DateTime;
use App\Models\RFO_Gangguan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library


class RFOGangguanController extends Controller
{
    // Index function to get All RFO Gangguan
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $status = $request->get('status');
        if($status==null && $keyword == null){
            $rfo_gangguan = RFO_Gangguan::where('deleted_at',null)->with('user')->paginate(10);
        }else if(!empty($status) && $keyword == null){
            $rfo_gangguan = RFO_Gangguan::where([
                ['status', $status],
                ['deleted_at',null]
            ])->with('user')->paginate(10);
        }else if(!empty($keyword) && $status == null ){
            $rfo_gangguan = RFO_Gangguan::where([
                ['nomor_rfo_gangguan', $keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['problem', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['nomor_tiket', $keyword],
                ['deleted_at',null]
            ])->with('user')->paginate(10);
        }else if(!empty($status) && !empty($keyword)){
            $rfo_gangguan = RFO_Gangguan::where([
                ['status', $status],
                ['nomor_rfo_gangguan', $keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['status', $status],
                ['problem', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->with('user')->paginate(10);
        }
        
        if($rfo_gangguan->isNotEmpty()){
            return response()->json([
                'status' => 'Success',
                'message' => 'Load Data RFO Gangguan succesfully',
                'data' => $rfo_gangguan], 200);
        }else{
            return response()->json([
                'status'=>"Success",
                'message' => 'Load data RFO Gangguan Not Found',
            ],404);
        }      
    }

    // Store RFO Gangguan function
    public function store(Request $request)
    {
        $this->validate($request, [
            'mulai_gangguan' => 'required',
            'selesai_gangguan' => 'required',
            'problem' => 'required',
            'action' => 'required',
        ]);

        // Format:
        // #RFO-S051102212345
        // # = hashtag
        // T = Trouble
        // date() = YYYY-MM-DD
        // Random Interger = 5 Digit

        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $id_user = $jwt_id['id_user'];

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

        try {
            $RFO_Gangguan = RFO_Gangguan::create([
                'user_id' => $id_user,
                'nomor_tiket' => $nomor_tiket,
                'mulai_gangguan' => $mulai_gangguan,
                'selesai_gangguan' => $selesai_gangguan,
                'problem' => $problem,
                'durasi' => $durasi->format("%d Hari - %h Jam - %i Menit"),
                'action' => $action,
                'status' => $status_RFO,
                'deskripsi' => $deskripsi,
                'nomor_rfo_gangguan' => $nomor_rfo_gangguan,
            ]);
            $message = 'Data RFO Keluhan added successfully';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            $http_code = 404;
        }
        $RFO_gangguan_id = $RFO_Gangguan->id_rfo_gangguan;
        return response([
            'status' => $status,
            'message' => $message,
            'id_rfo_gangguan' => $RFO_gangguan_id
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
            $message = 'Data RFO Gangguan not found';
            $http_code = 404;
            return response()->json([
                'status' => $status,
                'message' => $message], $http_code);
        }else{
            $rfo_gangguan->user;
            $rfo_gangguan->keluhan;
            $message = 'Data RFO Gangguan has found';
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
        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $id_user = $jwt_id['id_user'];
        $start = new DateTime($request->mulai_gangguan);//start time
        $end = new DateTime($request->selesai_gangguan);//end time
        $durasi = $start->diff($end);
        $rfo_gangguan = RFO_Gangguan::find($id);
        if (!$rfo_gangguan) {
            $status = 'Error';
            $message = 'Data RFO Gangguan not found';
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }else{
            try {
                $rfo_gangguan->update([
                    'user_id' => $id_user,
                    'nomor_tiket' => $request->nomor_tiket,
                    'mulai_gangguan' => $request->mulai_gangguan,
                    'selesai_gangguan' => $request->selesai_gangguan,
                    'durasi' => $durasi->format("%d Hari - %h Jam - %i Menit"),
                    'problem' => $request->problem,
                    'action' => $request->action,
                    'status' => $request->status,
                    'deskripsi' => $request->deskripsi,
                ]);
                $message = 'Data RFO gangguan updated successfully';
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

    // Search RFO Gangguan function with keeyword and closed status
    public function search(Request $request)
	{
        $keyword = $request->get('keyword');
        $data = RFO_Gangguan::where([
                ['nomor_rfo_gangguan', $keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['problem', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['nomor_tiket', $keyword],
                ['deleted_at',null]
            ])->paginate(10);

        if($data->isEmpty()){
            $message = 'Data history RFO Gangguan not found';
            $status = 'Error';
            $http_code = 404;
            return response()->json([
                'status' => $status,
                'message' => $message,
            ], $http_code);
        }else{
            $message = 'Data history RFO Gangguan has found';
            $status = 'Success';
            $http_code = 200;
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
        $rfo_gangguan = RFO_Gangguan::find($id);
        if (!empty($rfo_gangguan)){
            try {
                $rfo_gangguan->update([
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
        }else{
            $message = 'Data RFO Gangguan not found';
            $status = 'Error';
            $http_code = 404;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }
}
