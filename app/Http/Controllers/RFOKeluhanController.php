<?php

namespace App\Http\Controllers;
use DateTime;
use App\Models\RFO_Keluhan;
use App\Models\RFO_Gangguan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library



class RFOKeluhanController extends Controller
{
    // Index function to get All RFO Keluhan
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        if($keyword == null){
            $rfo_keluhan = RFO_Keluhan::where('deleted_at',null)->orderBy('created_at', 'DESC')->with('user','user.role','user.pop','keluhan')->paginate(10);
        }else if(!empty($keyword)){
            $rfo_keluhan = RFO_Keluhan::where([
                ['nomor_rfo_keluhan',$keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['nomor_tiket',$keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['problem','iLike',"%{$keyword}%"],
                ['deleted_at',null]
            ])->orderBy('created_at', 'DESC')->with('user','user.role','user.pop','keluhan')->paginate(10);
        }else{
            return response()->json([
                'status'=> "Error",
                'message' => 'Invalid Request',
            ],404);
        }
        
        if($rfo_keluhan->isNotEmpty()){
        return response()->json([
            'status' => 'Success',
            'message' => 'Load data RFO Keluhan successfully',
            'data' => $rfo_keluhan], 200);
        }else{
            return response()->json([
                'status'=>'Success',
                'message' => 'Load data RFO Keluhan Empty',
            ],404);
        }      
    }

    // Store RFO Keluhan function
    public function store(Request $request)
    {
        $this->validate($request, [
            'mulai_keluhan' => 'required',
            'selesai_keluhan' => 'required',
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

        // $user_id = $request->input('user_id');
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
                'user_id' => $id_user,
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
            $message = 'Data RFO Keluhan not found';
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
            $message = 'Data RFO Keluhan has found';
            $status = 'Success';
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $rfo_keluhan], 200);
        }
    }

    // Search RFO Keluhan 
    public function search(Request $request)
	{
        $keyword = $request->get('keyword');
        $data = RFO_Keluhan::where([
                ['nomor_rfo_keluhan',$keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['nomor_tiket',$keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['problem','iLike',"%{$keyword}%"],
                ['deleted_at',null]
            ])->paginate(10);

        if($data->isEmpty()){
            return response()->json([
                'status' => 'Error',
                'message' => 'Data RFO Keluhan not found',
            ], 404);
        }else{
            return response()->json([
                'status' => 'Success',
                'message' => 'Data RFO Keluhan has found',
                'data' => $data
            ], 200);
        }
    }  

    // Search RFO Keluhan and RFO RFO Gangguan
    public function searchRFO(Request $request)
	{
        //type= single and group
        $type = $request->get('type');
        $keyword = $request->get('keyword');
        if($type == 'single' || $type == null){
            $data = RFO_Keluhan::where([
                ['nomor_rfo_keluhan',$keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['nomor_tiket',$keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['problem','iLike',"%{$keyword}%"],
                ['deleted_at',null]
            ])->paginate(10);

            if($data->isEmpty()){
                $message = 'Data history RFO Keluhan not found';
                $status = 'Error';
                $http_code = 404;
                return response()->json([
                    'status' => $status,
                    'message' => $message,
                ], $http_code);
            }else{
                $message = 'Data history RFO Keluhan has found';
                $status = 'Success';
                $http_code = 200;
                return response()->json([
                    'status' => $status,
                    'message' => $message,
                    'data' => $data,
                ], $http_code);
            }
        }elseif ($type == 'group') {
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
                    'data' => $data,
                ], $http_code);
            }
        }
        else{
            $message = 'Input not valid';
            $status = 'Error';
            $http_code = 404;
            return response()->json([
                'status' => $status,
                'message' => $message,
            ], $http_code);
        }
    }  

    // Update RFO Keluhan function
    public function update(Request $request, $id)
    {
        
        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $id_user = $jwt_id['id_user'];
        $start = new DateTime($request->mulai_keluhan);//start time
        $end = new DateTime($request->selesai_keluhan);//end time
        $durasi = $start->diff($end);
        $rfo_keluhan = RFO_Keluhan::find($id);
        if (!$rfo_keluhan) {
            $status = 'Error';
            $message = 'Data RFO Keluhan not found';
            return response()->json([
                'status' => $status,
                'message' => $message], 404);
        }else{
            try {
                $rfo_keluhan->update([
                    'user_id' => $id_user,
                    // 'keluhan_id' => $request->keluhan_id,
                    'nomor_tiket' => $request->nomor_tiket,
                    'mulai_keluhan' => $request->mulai_keluhan,
                    'selesai_keluhan' => $request->selesai_keluhan,
                    'durasi' => $durasi->format("%d Hari - %h Jam - %i Menit"),
                    'problem' => $request->problem,
                    'action' => $request->action,
                    // 'status' => $request->status,
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
    }

    // Delete RFO Gangguan function
    public function destroy($id)
    {
        $rfo_keluhan = RFO_Keluhan::find($id);
        if (!empty($rfo_keluhan)){
            try {
                $rfo_keluhan->update([
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
        }else{
            $message = 'Data RFO keluhan not found';
            $status = 'Error';
            $http_code = 404;
            }
        return response()->json([
            'status' => $status,
            'message' => $message,
            ], $http_code);
        }
}
