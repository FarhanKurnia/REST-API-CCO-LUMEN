<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Pop;
use DB;
use App\Models\User;
use App\Models\Notifikasi;
use App\Models\Notifikasi_Read;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library

class NotifikasiController extends Controller
{
    // Get All Notification (Read/Unread) User by JWT
    public function index()
    {
        $token = JWTAuth::getToken();
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $id_user = $id_jwt['id_user'];
        $notifikasi = Notifikasi_Read::where([['user_id',$id_user],['is_read',false]])->with('notifikasi')->get();
        if($notifikasi->isNotEmpty()){
            return response()->json([
                'status' => 'Success',
                'message' => 'Notification loaded successfully ',
                'data' => $notifikasi
            ], 200);
        }else{
            return response()->json([
                'status'=>"Success",
                'message' =>"Notification loaded successfully "
            ],200);
        }       
    }

    // Add Notification
    public function store(Request $request){
        $this->validate($request, [
            'keluhan_id' => 'required',
            'pop_id' => 'required',
            'id_response' => 'required',
        ]);
        $token = JWTAuth::getToken();
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $id_user = $id_jwt['id_user'];

        $keluhan_id = $request->input('keluhan_id');
        $pop_id = $request->input('pop_id');
        $id_response = $request->input('id_response');

        $keluhan_check = Keluhan::where('id_keluhan',$keluhan_id)->count();
        $pop_check = Pop::where('id_pop',$pop_id)->count();

        
        if ($keluhan_check>0 && $pop_check>0){   
            $keluhan = Keluhan::where('id_keluhan',$keluhan_id)->get();
            $user = User::where('id_user',$id_user)->get();
            $nama_user = $user[0]->name;
            $id_pelanggan = $keluhan[0]->id_pelanggan;
            $nama_pelanggan = $keluhan[0]->nama_pelanggan;
            try {
                // Keluhan Notification
                if ($id_response == 0) {
                    $notifikasi = Notifikasi::create([
                        'judul' => 'Keluhan baru '.$id_pelanggan.' - '.$nama_pelanggan,
                        'detail' => 'Terdapat keluhan baru a.n pelanggan  '
                        .$id_pelanggan.' - '.$nama_pelanggan.'. Diupdate oleh '.$nama_user,
                        'keluhan_id' => $keluhan_id,
                        'deep_link' => 'http://localhost/3000/dashboard/detail/'.$keluhan_id,
                        'user_id_notif' => null,
                        'pop_id' => $pop_id,
                    ]);
                }
                // Balasan Notification
                elseif ($id_response == 1) {
                    $notifikasi = Notifikasi::create([
                        'judul' => 'Balasan baru '.$id_pelanggan.' - '.$nama_pelanggan,
                        'detail' => 'Terdapat balasan terbaru untuk keluhan a.n pelanggan  '
                        .$id_pelanggan.' - '.$nama_pelanggan.'. Diupdate oleh '.$nama_user,
                        'keluhan_id' => $keluhan_id,
                        'deep_link' => 'http://localhost/3000/dashboard/detail/'.$keluhan_id,
                        'user_id_notif' => null,
                        'pop_id' => $pop_id,
                    ]);
                }else{
                    return response([
                        'status' => 'Error',
                        'message' => 'Invalid ID response',
                    ], 404);
                }
                $status = 'Success';
                $message = 'Notification added successfully';
                $http_code = 200;
            } catch (\Throwable $th) {
                $status = 'Error';
                $message = $th->getMessage();
                $http_code = 404;
            } 
            return response([
                'status' => $status,
                'message' => $message,
                'notifikasi' => $notifikasi,
            ], $http_code);
        }else{
                $message = 'Data keluhan or POP not found';
                $status = 'Error';
                $http_code = 404;
                return response([
                    'status' => $status,
                    'message' => $message,
                ], $http_code);
        }
    }

    // Broadcast Notification
    public function broadcast(Request $request){
        $token = JWTAuth::getToken();
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $id_pop = $id_jwt['pop_id'];
        $id_user = $id_jwt['id_user'];

        $notifikasi_id = $request->input('notifikasi_id');
        $user = User::where([['pop_id',$id_pop],['online',true],['id_user','!=',$id_user]])->get();
        $list_user[] = [];

        foreach ($user as $index => $users) {
            $list_user[$index] = $users['id_user'];
        }
        $null_array[0] = [];
        if ($list_user == $null_array) {
            $message = 'Notification broadcasted successfully with 0 person online';
            $status = 'Success';
            $http_code = 200;
        }else{
            $id_notfikasi_cek = Notifikasi::find($notifikasi_id);
            if($id_notfikasi_cek != null){
                foreach ($list_user as $index => $id_user) {
                    $notifikasi_cek = Notifikasi_Read::where([
                        ['notifikasi_id',$notifikasi_id],
                        ['user_id',$id_user],
                    ])->first();
                    if($notifikasi_cek == null){
                        $notifikasi_read = Notifikasi_Read::create([
                            'notifikasi_id' => $notifikasi_id,
                            'is_read' => false,
                            'user_id' => $id_user,
                        ]);
                        $message = 'Notification broadcasted successfully';
                        $status = 'Success';
                        $http_code = 200;
                    }else{
                        $message = 'Notification broadcasted unsuccessfully';
                        $status = 'Error';
                        $http_code = 404;
                    }
                }
            }else{
                $message = 'Notification not found';
                $status = 'Error';
                $http_code = 404;
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }

    //  Read one notification
    public function read(Request $request)
    {
        $id_notifikasiread = $request->input('id_notifikasiread');
        $notifikasi= Notifikasi_Read::find($id_notifikasiread);
        try {
            if($notifikasi != null){
                $read = $notifikasi['is_read'];
                if($read == false){
                    $notifikasi->update([
                        'is_read' => true,
                    ]);
                    $message = 'Notification read successfully';
                    $status = 'Success';
                    $http_code = 200;
                } else{
                    $message = 'Notification has been read';
                    $status = 'Error';
                    $http_code = 404;
                }
            }else{
                $message = 'Notification not found';
                $status = 'Error';
                $http_code = 404;
            }
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

    // Read all notification by JWT Token
    public function read_all()
    {
        $token = JWTAuth::getToken();
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $id_user = $id_jwt['id_user'];

        $notifikasiread = Notifikasi_Read::where([
            ['user_id',$id_user],
            ['is_read',false]
            ])->get();
        $list_notifikasi[] = [];

        foreach ($notifikasiread as $index => $notifikasireads) {
            $list_notifikasi[$index] = $notifikasireads['id_notifikasiread'];
        }

        if ($list_notifikasi[0] != null) {
            foreach ($list_notifikasi as $index => $id_notifikasiread) {
                $notifikasi_read = Notifikasi_Read::find($id_notifikasiread)->update([
                    'is_read' => true,
                ]);
            }
            $status = 'Success';
            $message = 'Notification has been read succesfully';
            $http_code = 200;
        }else{
            $status = 'Error';
            $message = 'Notification has been read unsuccesfully';
            $http_code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }

    // Read all notification in one case by JWT Token
    public function read_all_one_case(Request $request)
    {
        $token = JWTAuth::getToken();
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $id_user = $id_jwt['id_user'];
        $keluhan_id = $request->input('keluhan_id');

        $notifikasi = Notifikasi::where('keluhan_id',$keluhan_id)->get();
        $list_id_notifikasi[] = [];

        foreach ($notifikasi as $index => $notifikasis) {
            $list_id_notifikasi[$index] = $notifikasis['id_notifikasi'];
        }

        if ($list_id_notifikasi[0] != null) {
            foreach ($list_id_notifikasi as $index => $list_id_notifikasis) {
                $notifikasi_read = Notifikasi_Read::where([
                    ['notifikasi_id',$list_id_notifikasis],
                    ['user_id',$id_user],
                    ])->update([
                    'is_read' => true,
                ]);
            }
            $status = 'Success';
            $message = 'Notification has been read succesfully';
            $http_code = 200;
        }else{
            $status = 'Success';
            $message = 'Notification has been read all';
            $http_code = 200;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }
}