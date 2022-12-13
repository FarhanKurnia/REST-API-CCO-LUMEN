<?php

namespace App\Http\Controllers;
use DB;

use App\Events\KeluhanEvent;
use Illuminate\Support\Carbon;
use App\Models\Keluhan;

use App\Models\RFO_Gangguan;
use App\Models\RFO_Keluhan;
use Illuminate\Http\Request;


class KeluhanController extends Controller
{
    // Index function for get all complaint with status open
    public function index(){
        $today = Carbon::now()->format('Y-m-d');
        $data = Keluhan::where('status','open')
        ->orwhere([
            ['status','closed'],
            ['updated_at','iLIKE', "%{$today}%"],
        ])
        ->orderBy('created_at', 'DESC')
        ->with('pop','balasan','RFO_Gangguan','RFO_Keluhan','lampirankeluhan')
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
                'mesage' =>"Data Keluhan not found"
            ],404);
        }
    }

    // History function to check complaint that has been closed in that session
    public function history(){
        $data = Keluhan::where('status','=','closed')->orderBy('created_at', 'DESC')->with('pop','balasan')->paginate(10);;
        if($data->isNotEmpty()){
            return response()->json([
                'status' => 'Success',
                'message' => 'Data history keluhan found',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'status'=>'Error',
                'mesage' =>'Data history keluhan not found'
            ],404);
        }
    }

    // Search keluhan function that has been closed with keyword
    public function search(Request $request)
	{
        $keyword = $request->get('keyword');
        $data = Keluhan::where([
            ['status', 'closed'],
            ['id_pelanggan', 'LIKE', "%{$keyword}%"],
        ])->orwhere([
            ['status', 'closed'],
            ['nama_pelanggan', 'iLIKE', "%{$keyword}%"],
        ])->orwhere([
            ['status', 'closed'],
            ['nama_pelapor', 'iLIKE', "%{$keyword}%"],
        ])->orwhere([
            ['status', 'closed'],
            ['nomor_pelapor', 'iLIKE', "%{$keyword}%"],
        ])->orwhere([
            ['status', 'closed'],
            ['nomor_keluhan', $keyword],
        ])->orwhere([
            ['status', 'closed'],
            ['keluhan', 'iLIKE', "%{$keyword}%"],
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

    // Store keluhan function
    public function store(Request $request){
        $message = 'Data keluhan added successfully';
        $status = 'Success';

        $id_pelanggan = $request->input('id_pelanggan');
        $nama_pelanggan = $request->input('nama_pelanggan');
        $nama_pelapor = $request->input('nama_pelapor');
        $nomor_pelapor = $request->input('nomor_pelapor');
        $nomor_keluhan = '#T'.date("Ymd").rand( 10000 , 99999 );
        $sumber_id = $request->input('sumber_id');
        $detail_sumber = $request->input('detail_sumber');
        $keluhan = $request->input('keluhan');
        $status_keluhan = $request->input('status');
        $pop_id = $request->input('pop_id');
        $user_id = $request->input('user_id');
        $rfo_gangguan_id = $request->input('rfo_gangguan_id');
        $rfo_keluhan_id = $request->input('rfo_keluhan_id');
        $sentimen_analisis = $request->input('sentimen_analisis');

        try {
            $keluhan = Keluhan::create([
                'id_pelanggan' => $id_pelanggan,
                'nama_pelanggan' => $nama_pelanggan,
                'nama_pelapor' => $nama_pelapor,
                'nomor_pelapor' => $nomor_pelapor,
                'nomor_keluhan' => $nomor_keluhan,
                'sumber_id' => $sumber_id,
                'detail_sumber' => $detail_sumber,
                'keluhan' => $keluhan,
                'status' => $status_keluhan,
                'pop_id' => $pop_id,
                'user_id' => $user_id,
                'rfo_gangguan_id'=> $rfo_gangguan_id,
                'rfo_keluhan_id'=> $rfo_keluhan_id,
                'sentimen_analisis'=>$sentimen_analisis,
            ]);
            $id_keluhan = $keluhan['id_keluhan'];
            event(new KeluhanEvent([
                'id'=>'1',
                'title'=>'Keluhan Baru',
                'desc'=>'Terdapat keluhan baru',
            ]));
            $beamsClient = new \Pusher\PushNotifications\PushNotifications(array(
                "instanceId" => "a81f4de8-8096-4cc9-a1d0-5c92138936f1",
                "secretKey" => "0E05168334D97E19A34BDACEA392DEF4648170ED7CF07C3B966E2F5EC059068A",
              ));
              $publishResponse = $beamsClient->publishToInterests(
                array("update"),
                array("web" => array("notification" => array(
                  "title" => "Keluhan baru",
                  "body" => "Terdapat update keluhan terbaru",
                  // url backend
                  // "deep_link" => url('/api/keluhan/'.$id_keluhan),
                  // url frontend
                  "deep_link" => "http://localhost:3000/dashboard/detail/".$id_keluhan,
                )),
              ));
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }

        return response([
            'status' => $status,
            'message' => $message,
            'id_keluhan' => $keluhan,
        ], 200);
    }

    // Show keluhan function with balasan
    public function show($id)
    {
        $message = "Data Keluhan found";
        $status = 'Success';
        $keluhan = Keluhan::find($id);
        try {
            if (!$keluhan) {
                $status = "error";
                $message = "Data Keluhan not found";
                return response()->json([
                    'status'=>$status,
                    'mesage' =>$message
                ],404);
            }else{
                $keluhan->user;
                $keluhan->pop;
                $keluhan->balasan;
                $keluhan->lampirankeluhan;
                $keluhan->rfo_keluhan;
                $keluhan->rfo_gangguan;
                return response()->json([
                    'status' => $status,
                    'message' => $message,
                    'data' =>$keluhan,
                ],200);
            }
        } catch (\Throwable $th) {
            $status = "Error";
            $message = $th->getMessage();
            return response()->json([
                'status' => $status,
                'message' => $message,
            ], 200);
        }
    }

    // Update keluhan function
    public function update(Request $request, $id)
    {
        $message = 'Data keluhan updated successfully';
        $status = 'Success';

        try {
            Keluhan::find($id)->update([
                'pop_id' => $request->pop_id,
                'nama_pelapor' => $request->nama_pelapor,
                'nomor_pelapor' => $request->nomor_pelapor,
                'sumber_id' => $request->sumber_id,
                'detail_sumber' => $request->detail_sumber,
            ]);
        } catch (\Throwable $th) {
            $status = "Error";
            $message = $th->getMessage();
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    // Close Keluhan function 
    public function close(Request $request, $id)
    {
        $message = 'Data keluhan successfully closed';
        $status = 'Success';

        try {
            Keluhan::find($id)->update([
                'status' => $request->status_keluhan='closed',
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

    // Update RFO Gangguan function when keluhan has been closed
    public function updateKeluhanRFOGangguan(Request $request, $id)
    {
        $message = 'Data keluhan RFO Gangguan successfully updated';
        $status = "success";

        try {
            Keluhan::find($id)->update([
                'rfo_gangguan_id' => $request->rfo_gangguan_id,
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

    // Update RFO Keluhan function when keluhan has been closed
    public function updateKeluhanRFOKeluhan(Request $request, $id)
    {
        $message = 'Data keluhan RFO Keluhan updated successfully';
        $status = "success";

        try {
            Keluhan::find($id)->update([
                'rfo_keluhan_id' => $request->rfo_keluhan_id,
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
        try {
            Keluhan::find($id)->delete();
            $message = 'Data keluhan has been deleted';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            $http_code = 404;

        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }
}
