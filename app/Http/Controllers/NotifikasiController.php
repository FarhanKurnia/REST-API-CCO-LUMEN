<?php

namespace App\Http\Controllers;

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

        $notifikasi = Notifikasi_Read::where('user_id',$id_user)->with('notifikasi')->get();
        return response()->json([
            'status' => 'Data Notifikasi berhasil dimuat',
            'message' => 'Success',
            'data' => $notifikasi
        ], 200);
    }

    // Add Notification
    public function store(Request $request){
        $keluhan_id = $request->input('keluhan_id');
        $pop_id = $request->input('pop_id');

        try {
            $notifikasi = Notifikasi::create([
                'judul' => 'Update baru',
                'detail' => 'Terdapat update terbaru',
                'keluhan_id' => $keluhan_id,
                'deep_link' => 'http://localhost/3000/dashboard/detail/'.$keluhan_id,
                'user_id_notif' => null,
                'pop_id' => $pop_id,
            ]);
            $message = 'Data keluhan berhasil dimasukan';
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
            'notifikasi' => $notifikasi,
        ], $http_code);
    }

    // Broadcast Notification
    public function broadcast(Request $request){
        $token = JWTAuth::getToken();
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $id_pop = $id_jwt['pop_id'];

        $notifikasi_id = $request->input('notifikasi_id');
        $user = User::where([['pop_id',$id_pop],['online',true]])->get();
        $list_user[] = [];
        foreach ($user as $index => $users) {
            $list_user[$index] = $users['id_user'];
        }
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
                    $message = 'Notifikasi berhasil dibroadcast';
                    $status = 'Success';
                    $http_code = 200;
                }else{
                    $message = 'Notifikasi sudah dibroadcast';
                    $status = 'Error';
                    $http_code = 404;
                }
            }
        }else{
            $message = 'Notifikasi tidak ditemukan';
            $status = 'Error';
            $http_code = 404;
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
                    $message = 'Notifikasi berhasil diread';
                    $status = "Success";
                    $http_code = 200;
                } else{
                    $message = 'Notifikasi sudah dibaca';
                    $status = 'Failed';
                    $http_code = 404;
                }
            }else{
                $message = 'Notifikasi tidak ditemukan';
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

    // Read all notification by JTW Token
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
            $message = 'Notifikasi berhasil dibaca semua';
            $http_code = 200;
        }else{
            $status = 'Error';
            $message = 'Notifikasi sudah dibaca semua';
            $http_code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }
}
