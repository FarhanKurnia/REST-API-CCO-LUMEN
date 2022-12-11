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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotifikasiAllRead()
    {
//         FROM notification n
//          JOIN category c ON (n.category_id = c.id)
//          LEFT JOIN notification_read nr ON (nr.notification_id = n.id)
// WHERE (n.user_id = 'eko' OR n.user_id IS NULL)
//   AND (nr.user_id = 'eko' OR nr.user_id IS NULL)
// ORDER BY n.create_at DESC;

    //     $productCategory = Product::where('id', $productId)
    // ->leftJoin('category', 'product.category', '=', 'category.id')
    // ->select('product.id','category.name')->first();

    // ->leftjoin('category','category.product_id','=','products.id')

    // Take JWT ID as ID in Database
    $token = JWTAuth::getToken();
    $id_jwt = JWTAuth::getPayload($token)->toArray();
    $id_user = $id_jwt['id_user'];
    $id_pop = $id_jwt['pop_id'];
    // $notifikasi = Notifikasi::leftjoin('notifikasi__reads','notifikasi__reads.notifikasi_id','=','notifikasis.id_notifikasi')
    //     // ->where('notifikasis.user_id_notif', null)
    //     // ->orwhere('notifikasi__reads.user_id', null)
    //     // ->where('notifikasis.user_id_notif', null)
    //     // ->orwhere('notifikasi__reads.user_id', $id_user)
    //     ->where([
    //         ['notifikasis.user_id_notif', null],
    //         ['notifikasi__reads.user_id', null]
    //         ])
    //     ->orwhere([
    //         ['notifikasis.user_id_notif', null],
    //         ['notifikasi__reads.user_id', $id_user]
    //     ])
    //     ->get();

    $notifikasi = DB::select( DB::raw("SELECT * FROM notifikasis n
    JOIN pops p ON (n.pop_id = p.id_pop)
    LEFT JOIN notifikasi__reads nr ON (nr.notifikasi_id = n.id_notifikasi)
    WHERE (n.user_id_notif IS NULL)
    AND (nr.user_id = '$id_user' OR nr.user_id IS NULL)
    AND (n.pop_id = $id_pop)
    ORDER BY n.created_at DESC"));
    return response()->json([
        'status' => 'Data Notifikasi berhasil ditemukan',
        'message' => 'success',
        'data' => $notifikasi
    ], 200);
        // if($notifikasi->isNotEmpty()) {
        //     return response()->json([
        //         'status' => 'Data Notifikasi berhasil ditemukan',
        //         'message' => 'success',
        //         'data' => $notifikasi
        //     ], 200);
        // }else{
        //     return response()->json([
        //         'status'=>"error",
        //         'mesage' =>"Data Notifikasi tidak ditemukan"
        //     ],404);
        // }
    }

    public function getNotifikasi()
    {
        $token = JWTAuth::getToken();
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $id_user = $id_jwt['id_user'];
        $id_pop = $id_jwt['pop_id'];

        $notifikasi = Notifikasi::where('pop_id',$id_pop)->with('notifikasi_read','pop')->get();
        // $notif = $notifikasi->notifikasi_read;
        // dd($notif);
        return response()->json([
            'status' => 'Data Notifikasi berhasil dimuat',
            'message' => 'success',
            'data' => $notifikasi
        ], 200);
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

    public function read_all(Request $request)
    {

        
    }
    
    public function read(Request $request)
    {
        
        $message = 'Notifikasi berhasil dibaca';
        $status = "success";

         // Take JWT ID as ID in Database
        $token = JWTAuth::getToken();
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $id_user = $id_jwt['id_user'];
        
        //'is_read', 'notifikasi_id', 'user_id',
        $is_read = true;
        $notifikasi_id = $request->input('notifikasi_id');
        // $notifikasi = Notifikasi::with('keluhan');
        // dd($notifikasi);

        // try {
            $notifikasi_cek = Notifikasi_Read::where([
                ['notifikasi_id',$notifikasi_id],
                ['user_id',$id_user],
            ])->first();
            // dd($notifikasi_cek);
            if($notifikasi_cek == null){
                $notifikasi_read = Notifikasi_Read::create([
                    'notifikasi_id' => $notifikasi_id,
                    'is_read' => $is_read,
                    'user_id' => $id_user,
                ]);
                return response([
                    'status' => $status,
                    'message' => $message,
                    'notifikasi_read' => $notifikasi_read,
                ], 200);  
            }else{
                return response([
                    'status' => 'Error',
                    'message' => 'Notifikasi sudah dibaca',]);
            }    
            
        // } catch (\Throwable $th) {
        //     $status = "error";
        //     $message = $th->getMessage();
        // }

        
    }

    public function store(Request $request){
        $message = 'Data keluhan berhasil dimasukan';
        $status = "success";

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
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }

        return response([
            'status' => $status,
            'message' => $message,
            'notifikasi' => $notifikasi,
        ], 200);
    }

    public function store_all(Request $request){
        $token = JWTAuth::getToken();
        $id_jwt = JWTAuth::getPayload($token)->toArray();
        $id_pop = $id_jwt['pop_id'];
        $message = 'Data keluhan berhasil dimasukan';
        $status = "success";

        // $keluhan_id = $request->input('keluhan_id');
        // $pop_id = $request->input('pop_id');
        $notifikasi_id = 1;
        $user = User::where('pop_id',$id_pop)->get();
        $list_user[] = [];
        foreach ($user as $index => $users) {
            $list_user[$index] = $users['id_user'];
        }
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
            }else{
            return response([
                'status' => 'Error',
                'message' => 'Notifikasi sudah dibuat',]);
            }       
        }

        return response([
            'status' => $status,
            'message' => $message,
            // 'User' => $notifikasi_read,
        ], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function show(Notifikasi $notifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Notifikasi $notifikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notifikasi $notifikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notifikasi  $notifikasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notifikasi $notifikasi)
    {
        //
    }
}
