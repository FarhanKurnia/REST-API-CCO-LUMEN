<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Http\Request;
class KeluhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Keluhan::with('user')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Load data post successfully',
            // 'data' => Keluhan::all()
            'data' => $data
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
    public function store(Request $request)
    {
        $message = 'Data created successfully';
        $status = "success";

        $id_pelanggan = $request->input('id_pelanggan');
        $nama_pelanggan = $request->input('nama_pelanggan');
        $nama_pelapor = $request->input('nama_pelapor');
        $nomor_pelapor = $request->input('nomor_pelapor');
        $nomor_keluhan = $request->input('nomor_keluhan');
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
        $message = "Load data post successfully";
        $status = "success";
        $keluhan = Keluhan::find($id);

        if (!$keluhan) {
            $status = "error";
            $message = "Data keluhan not found";
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $keluhan::with('user','balasan')->where('id',$id)->get()], 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keluhan  $keluhan
     * @return \Illuminate\Http\Response
     */
    public function edit(Keluhan $keluhan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Keluhan  $keluhan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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