<?php

namespace App\Http\Controllers;

use App\Models\Balasan;
use Illuminate\Http\Request;
use App\Events\KeluhanEvent;

class BalasanController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Load data Balasan successfully',
            'data' => Balasan::with('user','lampiranbalasan')->get()], 200);
    }

    public function store(Request $request)
    {
        $message = 'Balasan created successfully';
        $status = "success";

        $user_id = $request->input('user_id');
        $keluhan_id = $request->input('keluhan_id');
        $balasan = $request->input('balasan');

        try {
            $balasan = Balasan::create([
                'user_id' => $user_id,
                'keluhan_id' => $keluhan_id,
                'balasan' => $balasan,
            ]);
            $id_keluhan = $balasan['keluhan_id'];
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
                  "title" => "Balasan baru",
                  "body" => "Terdapat update balasan terbaru",
                //   "deep_link" => url('/api/keluhan/'.$id_keluhan),
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
            'id_balasan' => $balasan->id_balasan,
        ], 200);
    }

    public function show($id)
    {
        $message = "Load data post successfully";
        $status = "success";
        $balasan = Balasan::find($id);
        if (!$balasan) {
            $status = "error";
            $message = "Data balasan not found";
            return response()->json([
                'status' => $status,
                'message' => $message
            ], 404);
        }else{
            $balasan->user;
            $balasan->user->role;
            $balasan->keluhan;
            $balasan->lampiranbalasan;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $balasan], 200);
        }
    }
}
