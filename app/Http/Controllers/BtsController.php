<?php

namespace App\Http\Controllers;
// namespace App\Http\Middleware;
// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
use App\Models\Bts;
use Illuminate\Http\Request;

class BtsController extends Controller
{
    // Enable if u neef middleware in controller (not in route)
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $bts = Bts::with('pop')->get();
        if($bts->isNotEmpty()) {
            return response()->json([
                'status' => 'Data BTS berhasil ditemukan',
                'message' => 'success',
                'data' => $bts
            ], 200);
        }else{
            return response()->json([
                'status'=>"error",
                'mesage' =>"Data BTS tidak ditemukan"
            ],404);
        }
    }

    public function store(Request $request)
    {
        $message = 'Data BTS berhasil dimasukan';
        $status = "success";

        $nama_bts = $request->input('nama_bts');
        $nama_pic = $request->input('nama_pic');
        $nomor_pic = $request->input('nomor_pic');
        $lokasi = $request->input('lokasi');
        $pop_id = $request->input('pop_id');
        $kordinat = $request->input('kordinat');
        $user_id = $request->input('user_id');

        try {
            Bts::create([
                'nama_bts' => $nama_bts,
                'nama_pic' => $nama_pic,
                'nomor_pic' => $nomor_pic,
                'lokasi' => $lokasi,
                'pop_id' => $pop_id,
                'kordinat' => $kordinat,
                'user_id' => $user_id,
            ]);
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }

        return response([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    public function show($id)
    {
        $message = "Data BTS ditemukan";
        $status = "success";
        $bts = Bts::find($id);
        if (!$bts) {
            $status = "error";
            $message = "Data BTS tidak ditemukan";
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }else{
            $bts->user;
            $bts->user->role;
            $bts->user->pop;
            $bts->pop;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' =>$bts
            ],200);
        }
    }

    public function update(Request $request, $id)
    {
        $message = 'Data BTS berhasil diupdate';
        $status = "success";

        try {
            Bts::find($id)->update([
                'nama_bts' => $request->nama_bts,
                'nama_pic' => $request->nama_pic,
                'nomor_pic' => $request->nomor_pic,
                'lokasi' => $request->lokasi,
                'pop_id' => $request->pop_id,
                'kordinat' => $request->kordinat,
                'user_id' => $request->user_id,
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

    public function destroy($id)
    {
        $message = 'Data BTS berhasil dihapus';
        $status = "success";
        try {
            Bts::find($id)->delete();
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }
}
