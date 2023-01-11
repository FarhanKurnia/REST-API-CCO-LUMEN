<?php

namespace App\Http\Controllers;
use App\Models\POP;
use App\Models\Balasan;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use App\Events\KeluhanEvent;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library


class BalasanController extends Controller
{
    // Index function to get All Balasan with user and attachment
    public function index()
    {
        return response()->json([
            'status' => 'Success',
            'message' => 'Load data Balasan successfully',
            'data' => Balasan::with('user','lampiranbalasan')->get()], 200);
    }

    // Store balasan function
    public function store(Request $request)
    {
        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $id_user = $jwt_id['id_user'];
        $keluhan_id = $request->input('keluhan_id');
        $balasan = $request->input('balasan');

        try {
            $balasan = Balasan::create([
                'user_id' => $id_user,
                'keluhan_id' => $keluhan_id,
                'balasan' => $balasan,
            ]);
            $id_keluhan = $balasan['keluhan_id'];
            $keluhan = Keluhan::where('id_keluhan',$keluhan_id)->get();
            $id_pelanggan = $keluhan[0]->id_pelanggan;
            $nama_pelanggan = $keluhan[0]->nama_pelanggan;
            $id_pop = $keluhan[0]->pop_id;
            $pop = POP::where('id_pop',$id_pop)->pluck('pop');

            event(new KeluhanEvent([
                'id'=>'1',
                'title'=>'Balasan baru',
                'desc'=>'Terdapat balasan baru',
                // "deep_link" => 'localhost:3000/dashboard/detail/'.$id_keluhan,
            ]));
            $beamsClient = new \Pusher\PushNotifications\PushNotifications(array(
                "instanceId" => "a81f4de8-8096-4cc9-a1d0-5c92138936f1",
                "secretKey" => "0E05168334D97E19A34BDACEA392DEF4648170ED7CF07C3B966E2F5EC059068A",
              ));
              $publishResponse = $beamsClient->publishToInterests(
                array("update"),
                array("web" => array("notification" => array(
                  "title" => $pop[0]." | Balasan baru",
                  "body" => "Terdapat balasan baru  ".$id_pelanggan.' - '.$nama_pelanggan.' | POP '.$pop[0],
                //   "deep_link" => url('/api/keluhan/'.$id_keluhan),
                  "deep_link" => "http://localhost:3000/dashboard/detail/".$id_keluhan,
                )),
              ));
            $message = 'Balasan created successfully';
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
            // response for differently response for keluhan or balasan
            // 0 for keluhan and 1 for balasan
            'id_response' => 1,
            'id_balasan' => $balasan->id_balasan,
            'id_keluhan' => $keluhan[0]->id_keluhan,
        ], $http_code);
    }

    // Show function to get one balasan
    public function show($id)
    {
        $balasan = Balasan::find($id);
        if (!$balasan) {
            $status = "Failed";
            $message = "Data balasan not found";
            $http_code = 404;
            return response()->json([
                'status' => $status,
                'message' => $message
            ], $http_code);
        }else{
            $balasan->user;
            $balasan->user->role;
            $balasan->keluhan;
            $balasan->lampiranbalasan;
            $message = 'Show data balasan successfully';
            $status = 'Success';
            $http_code = 200;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $balasan], $http_code);
        }
    }
}
