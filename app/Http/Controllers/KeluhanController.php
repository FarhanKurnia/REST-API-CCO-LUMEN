<?php

namespace App\Http\Controllers;
use DB;

use App\Events\KeluhanEvent;
use Illuminate\Support\Carbon;
use App\Models\Keluhan;
use App\Models\POP;
use App\Models\RFO_Gangguan;
use App\Models\RFO_Keluhan;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library



class KeluhanController extends Controller
{
    // Index function for get all complaint with status open
    public function index(){
        $today = Carbon::now()->format('Y-m-d');
        $data = Keluhan::where([
            ['status','open'],
            ['deleted_at',null],
            ])
        ->orwhere([
            ['status','closed'],
            ['updated_at','iLIKE', "%{$today}%"],
        ])
        ->orderBy('created_at', 'DESC')
        ->with('pop','balasan','RFO_Gangguan','RFO_Keluhan','lampirankeluhan','notifikasi')
        ->get();
        if($data->isNotEmpty()){
            return response()->json([
                'status' => 'Success',
                'message' => 'Load data Keluhan successfully',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'status'=>"error",
                'message' =>"Data Keluhan not found"
            ],404);
        }
    }

    // History function to check complaint that has been closed in that session
    public function history(Request $request){
        $pop_id = $request->get('pop_id');
        $keyword = $request->get('keyword');
        if ($pop_id == null && $keyword == null) {
            $data = Keluhan::where([
                ['status','=','closed'],
                ['deleted_at',null],
                ])->orderBy('created_at', 'DESC')->with('pop','balasan')->paginate(10);
        }else if(!empty($pop_id) && $keyword==null){
            $data = Keluhan::where([
                ['status','=','closed'],
                ['pop_id',$pop_id],
                ['deleted_at',null],
                ])->orderBy('created_at', 'DESC')->with('pop','balasan')->paginate(10);
        }else if(!empty($keyword) && $pop_id == null){
            $data = Keluhan::where([
                ['status', 'closed'],
                ['id_pelanggan', 'LIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['nama_pelanggan', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['nama_pelapor', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['nomor_pelapor', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['nomor_keluhan', $keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['keluhan', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orderBy('created_at', 'DESC')->with('pop','balasan')->paginate(10);
        }else if(!empty($keyword) && !empty($pop_id)){
            $data = Keluhan::where([
                ['status', 'closed'],
                ['pop_id',$pop_id],
                ['id_pelanggan', 'LIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['pop_id',$pop_id],
                ['nama_pelanggan', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['pop_id',$pop_id],
                ['nama_pelapor', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['pop_id',$pop_id],
                ['nomor_pelapor', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['pop_id',$pop_id],
                ['nomor_keluhan', $keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['pop_id',$pop_id],
                ['keluhan', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orderBy('created_at', 'DESC')->with('pop','balasan')->paginate(10);
        }else{
            return response()->json([
                'status'=> "Error",
                'message' => 'Invalid Request',
            ],404);
        }
        
        if($data->isNotEmpty()){
            return response()->json([
                'status' => 'Success',
                'message' => 'Data history keluhan found',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'status'=>'Error',
                'message' =>'Data history keluhan not found'
            ],404);
        }
    }

    // Search riwayat keluhan function that has been closed with keyword
    public function search(Request $request)
	{
        $pop_id = $request->get('pop_id');
        $keyword = $request->get('keyword');
        if ($pop_id == null) {
            $data = Keluhan::where([
                ['status', 'closed'],
                ['id_pelanggan', 'LIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['nama_pelanggan', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['nama_pelapor', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['nomor_pelapor', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['nomor_keluhan', $keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['keluhan', 'iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->paginate(10);

            if($data->isEmpty()){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data history keluhan not found',
                ], 404);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data history keluhan found',
                    'data' => $data
                ], 200);
            }
        }else{
            $data = Keluhan::where([
                ['status', 'closed'],
                ['id_pelanggan', 'LIKE', "%{$keyword}%"],
                ['pop_id',$pop_id],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['nama_pelanggan', 'iLIKE', "%{$keyword}%"],
                ['pop_id',$pop_id],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['nama_pelapor', 'iLIKE', "%{$keyword}%"],
                ['pop_id',$pop_id],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['nomor_pelapor', 'iLIKE', "%{$keyword}%"],
                ['pop_id',$pop_id],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['nomor_keluhan', $keyword],
                ['pop_id',$pop_id],
                ['deleted_at',null]
            ])->orwhere([
                ['status', 'closed'],
                ['keluhan', 'iLIKE', "%{$keyword}%"],
                ['pop_id',$pop_id],
                ['deleted_at',null]
            ])->paginate(10);

            if($data->isEmpty()){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data history keluhan not found',
                ], 404);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data history keluhan found',
                    'data' => $data
                ], 200);
            }
        }
    }

    // Store keluhan function
    public function store(Request $request){
        $this->validate($request, [
            'kategori_pelanggan' => 'required',
            'id_pelanggan' => 'required',
            'nama_pelanggan' => 'required',
            'nama_pelapor' => 'required',
            'nomor_pelapor' => 'required',
            'sumber_id' => 'required',
            'detail_sumber' => 'required',
            'keluhan' => 'required',
            'pop_id' => 'required',
        ]);
        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $id_user = $jwt_id['id_user'];
        $kategori_pelanggan = $request->input('kategori_pelanggan');
        $id_pelanggan = $request->input('id_pelanggan');
        $nama_pelanggan = $request->input('nama_pelanggan');
        $nama_pelapor = $request->input('nama_pelapor');
        $nomor_pelapor = $request->input('nomor_pelapor');
        $nomor_keluhan = '#T'.date("Ymd").rand( 10000 , 99999 );
        $sumber_id = $request->input('sumber_id');
        $detail_sumber = $request->input('detail_sumber');
        $keluhan = $request->input('keluhan');
        $pop_id = $request->input('pop_id');
        $sentimen_analisis = $request->input('sentimen_analisis');

        $pop = POP::where('id_pop',$pop_id)->pluck('pop');

        try {
            $keluhan = Keluhan::create([
                'kategori_pelanggan' => $kategori_pelanggan,
                'id_pelanggan' => $id_pelanggan,
                'nama_pelanggan' => $nama_pelanggan,
                'nama_pelapor' => $nama_pelapor,
                'nomor_pelapor' => $nomor_pelapor,
                'nomor_keluhan' => $nomor_keluhan,
                'sumber_id' => $sumber_id,
                'detail_sumber' => $detail_sumber,
                'keluhan' => $keluhan,
                'status' => 'open',
                'pop_id' => $pop_id,
                'user_id' => $id_user,
                'sentimen_analisis'=>$sentimen_analisis,
            ]);
            $message = 'Data keluhan added successfully';
            $status = 'Success';
            $http_code = 200;
            $id_keluhan = $keluhan['id_keluhan'];

            event(new KeluhanEvent([
                'id'=>'1',
                'title'=> $pop[0].' | Keluhan Baru',
                'desc'=>'Terdapat keluhan baru POP'.$pop[0],
            ]));
            $beamsClient = new \Pusher\PushNotifications\PushNotifications(array(
                "instanceId" => "a81f4de8-8096-4cc9-a1d0-5c92138936f1",
                "secretKey" => "0E05168334D97E19A34BDACEA392DEF4648170ED7CF07C3B966E2F5EC059068A",
              ));
              $publishResponse = $beamsClient->publishToInterests(
                array("update"),
                array("web" => array("notification" => array(
                  "title" => $pop[0]." | Keluhan baru",
                  "body" => "Terdapat keluhan baru  ".$id_pelanggan.' - '.$nama_pelanggan.' | POP '.$pop[0],
                  // url backend
                  // "deep_link" => url('/api/keluhan/'.$id_keluhan),
                  // url frontend
                  "deep_link" => "https://app.skripsiprjt-utdi.my.id/dashboard/detail/".$id_keluhan,
                )),
              ));

        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            $http_code = 404;
        }

        return response([
            'status' => $status,
            'message' => $message,
            // response for differently response for keluhan or balasan
            // 0 for keluhan and 1 for balasan
            'id_response' => 0,
            'id_keluhan' => $id_keluhan,
        ], $http_code);
    }

    // Show keluhan function with balasan
    public function show($id)
    {

        $keluhan = Keluhan::find($id);
        try {
            if (!$keluhan) {
                $status = 'Error';
                $message = 'Data Keluhan not found';
                return response()->json([
                    'status'=>$status,
                    'message' =>$message
                ],404);
            }else{
                $keluhan->user;
                $keluhan->pop;
                $keluhan->balasan;
                $keluhan->lampirankeluhan;
                $keluhan->rfo_keluhan;
                $keluhan->rfo_gangguan;
                $message = 'Data Keluhan found';
                $status = 'Success';
                return response()->json([
                    'status' => $status,
                    'message' => $message,
                    'data' =>$keluhan,
                ],200);
            }
        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            return response()->json([
                'status' => $status,
                'message' => $message,
            ], 404);
        }
    }

    // Update keluhan function
    public function update(Request $request, $id)
    {
        $keluhan = Keluhan::find($id);
        if (!empty($keluhan)){   
            try {
                $keluhan->update([
                    'pop_id' => $request->pop_id,
                    'nama_pelapor' => $request->nama_pelapor,
                    'nomor_pelapor' => $request->nomor_pelapor,
                    'sumber_id' => $request->sumber_id,
                    'detail_sumber' => $request->detail_sumber,
                ]);
                $message = 'Data keluhan updated successfully';
                $status = 'Success';
                $http_code = 200;
            } catch (\Throwable $th) {
                $status = 'Error';
                $message = $th->getMessage();
                $http_code = 404;
            }
        }else{
            $message = 'Data keluhan not found';
            $status = 'Error';
            $http_code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }

    // Close Keluhan function
    public function close(Request $request, $id)
    {
        $keluhan = Keluhan::find($id);
        if (!empty($keluhan)){
            try {
                $keluhan->update([
                    'status' => $request->status_keluhan='closed',
                ]);
                $message = 'Data keluhan successfully closed';
                $status = 'Success';
                $http_code = 200;
            } catch (\Throwable $th) {
                $status = 'Error';
                $message = $th->getMessage();
                $http_code = 404;
            }
        }else{
            $message = 'Data keluhan not found';
            $status = 'Error';
            $http_code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }

    // Update RFO Gangguan function when keluhan has been closed
    public function updateKeluhanRFOGangguan(Request $request, $id)
    {
        $rfo_gangguan_id = $request->rfo_gangguan_id;
        $keluhan = Keluhan::find($id);
        $rfo_gangguan = RFO_Gangguan::where('id_rfo_gangguan',$rfo_gangguan_id)->count();        
        if (!empty($keluhan) && $rfo_gangguan>0){
            try {
            $keluhan->update([
                'rfo_gangguan_id' => $request->rfo_gangguan_id,
            ]);
            $message = 'Data keluhan RFO Gangguan updated successfully';
            $status = "success";
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            $http_code = 404;
        }
    }else{
        $message = 'Data keluhan or RFO Gangguan not found';
        $status = 'Error';
        $http_code = 404;
    }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }

    // Update RFO Keluhan function when keluhan has been closed
    public function updateKeluhanRFOKeluhan(Request $request, $id)
    {
        $rfo_keluhan_id = $request->rfo_keluhan_id;
        $keluhan = Keluhan::find($id);
        $rfo_keluhan = RFO_Keluhan::where('id_rfo_keluhan',$rfo_keluhan_id)->count();

        if (!empty($keluhan) && $rfo_keluhan>0){
            try {
                $keluhan->update([
                    'rfo_keluhan_id' => $request->rfo_keluhan_id,
                ]);
                $message = 'Data keluhan RFO Keluhan updated successfully';
                $status = 'Success';
                $http_code = 200;
            } catch (\Throwable $th) {
                $status = 'Error';
                $message = $th->getMessage();
                $http_code = 200;

            }
        }else{
            $message = 'Data keluhan or RFO Keluhan not found';
            $status = 'Error';
            $http_code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }

    // Re-open function for keluhan that has been closed
    public function open(Request $request, $id)
    {
        $keluhan = Keluhan::find($id);
        if (!empty($keluhan)){
            try {
                $keluhan->update([
                    'status' => $request->status_keluhan='open',
                    'rfo_gangguan_id' => $request->rfo_gangguan=null,
                    'rfo_keluhan_id' => $request->rfo_keluhan=null,
                ]);
                $message = 'Data keluhan re-opened successfully';
                $status = 'Success';
                $http_code = 200;
            } catch (\Throwable $th) {
                $status = "Error";
                $message = $th->getMessage();
                $http_code = 404;
            }
        }else{
            $message = 'Data keluhan not found';
            $status = 'Error';
            $http_code = 404;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }

    // Delete Keluhan function
    public function destroy($id)
    {   
        $keluhan = Keluhan::find($id);
        if (!empty($keluhan)){
            try {
                Keluhan::find($id)->update([
                    'deleted_at' => Carbon::now()]
                );
                $message = 'Data keluhan has been deleted';
                $status = 'Success';
                $http_code = 200;
            } catch (\Throwable $th) {
                $status = 'Error';
                $message = $th->getMessage();
                $http_code = 404;

            }
        }else{
            $message = 'Data keluhan not found';
            $status = 'Error';
            $http_code = 404;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }
}
