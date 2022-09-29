<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class KeluhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = Keluhan::where('status','=','open')->orderBy('created_at', 'DESC')->get();
        if($data->isNotEmpty()){
            return response()->json([
                'status' => 'success',
                'message' => 'Load data keluhan successfully',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'status'=>"error",
                'mesage' =>"Data keluhan tidak ditemukan"
            ],404);
        }
    }

    public function history(){
        $data = Keluhan::where('status','=','closed')->orderBy('created_at', 'DESC')->paginate(10);
        if($data->isNotEmpty()){
            return response()->json([
                'status' => 'success',
                'message' => 'Load data keluhan successfully',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'status'=>"error",
                'mesage' =>"Data keluhan tidak ditemukan"
            ],404);
        }
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
    public function store(Request $request){
        $message = 'Data keluhan created successfully';
        $status = "success";

        $id_pelanggan = $request->input('id_pelanggan');
        $nama_pelanggan = $request->input('nama_pelanggan');
        $nama_pelapor = $request->input('nama_pelapor');
        $nomor_pelapor = $request->input('nomor_pelapor');
        $nomor_keluhan = $request->input('nomor_keluhan');
        $source = $request->input('source');
        $sosmed = $request->input('sosmed');
        $email = $request->input('email');
        $keluhan = $request->input('keluhan');
        $status_keluhan = $request->input('status');
        $lampiran = $request->input('lampiran');
        $pop_id = $request->input('pop_id');
        $user_id = $request->input('user_id');


        try {
            Keluhan::create([
                'id_pelanggan' => $id_pelanggan,
                'nama_pelanggan' => $nama_pelanggan,
                'nama_pelapor' => $nama_pelapor,
                'nomor_pelapor' => $nomor_pelapor,
                'nomor_keluhan' => $nomor_keluhan,
                'source' => $source,
                'sosmed' => $sosmed,
                'email' => $email,
                'keluhan' => $keluhan,
                'status' => $status_keluhan,
                'lampiran' => $lampiran,
                'pop_id' => $pop_id,
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keluhan  $keluhan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = "Data Keluhan ditemukan";
        $status = "success";
        $keluhan = Keluhan::find($id);
        if (!$keluhan) {
            $status = "error";
            $message = "Data Keluhan tidak ditemukan";
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }else{
            $keluhan->user;
            $keluhan->user->role;
            $keluhan->user->pop;
            $keluhan->pop;
            $keluhan->balasan;
            //Masih gagal ambil nested query dari keluhan -> balasan -> user dan role
            // $keluhan->balasan->user(0);
            // dd($keluhan);
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' =>$keluhan
            ],200);
        }
    }

    public function update(Request $request, $id)
    {
        $message = 'Keluhan berhasil diupdate';
        $status = "success";

        try {
            Keluhan::find($id)->update([
                'pop_id' => $request->pop_id,
                'nama_pelapor' => $request->nama_pelapor,
                'nomor_pelapor' => $request->nomor_pelapor,
                'source' => $request->source,
                'sosmed' => $request->sosmed,
                'email' => $request->email,
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keluhan  $keluhan
     * @return \Illuminate\Http\Response
     */
    public function close(Request $request, $id)
    {
        $message = 'Keluhan berhasil ditutup';
        $status = "success";

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

    public function open(Request $request, $id)
    {
        $message = 'Keluhan berhasil dibuka';
        $status = "success";

        try {
            Keluhan::find($id)->update([
                'status' => $request->status_keluhan='open',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Keluhan  $keluhan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = 'Keluhan berhasil dihapus';
        $status = "success";
        try {
            Keluhan::find($id)->delete();
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
