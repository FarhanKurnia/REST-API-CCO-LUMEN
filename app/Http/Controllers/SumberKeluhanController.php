<?php

namespace App\Http\Controllers;

use App\Models\SumberKeluhan;
use Illuminate\Http\Request;

class SumberKeluhanController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Data Sumber keluhan berhasil dimuat',
            'data' => SumberKeluhan::get()], 200);
    }

    public function store(Request $request)
    {
        $message = 'Data Sumber Keluhan berhasil dimasukan';
        $status = "success";

        $id_sumber = $request->input('id_sumber');
        $sumber = $request->input('sumber');

        try {
            SumberKeluhan::create([
                'id_sumber' => $id_sumber,
                'sumber' => $sumber,
            ]);
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }

        return response([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    public function show($id)
    {
        $message = "Data Sumber Keluhan berhasil ditemukan";
        $status = "success";
        $sumber = SumberKeluhan::find($id);
        if (!$sumber) {
            $status = "error";
            $message = "Data Sumber Keluhan tidak ditemukan";
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }else{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' =>$sumber
            ],200);
        }
    }

    public function update(Request $request, $id)
    {
        $message = 'Data Sumber Keluhan berhasil ditemukan';
        $status = "success";

        try {
            SumberKeluhan::find($id)->update([
                'id_sumber' => $request->id_sumber,
                'sumber' => $request->sumber,
            ]);
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    public function destroy($id)
    {
        $message = 'Data sumber keluhan berhasil dihapus';
        $status = "success";
        try {
            SumberKeluhan::find($id)->delete();
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            return response()->json([
                'status'=>$status,
                'mesage' =>$message
            ],404);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }
}
