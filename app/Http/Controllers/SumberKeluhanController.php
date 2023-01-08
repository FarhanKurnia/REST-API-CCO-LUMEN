<?php

namespace App\Http\Controllers;

use App\Models\SumberKeluhan;
use Illuminate\Http\Request;

class SumberKeluhanController extends Controller
{
    // Index function for get all shift time for daily report
    public function index()
    {
        return response()->json([
            'status' => 'Success',
            'message' => 'Load source complaint successfully',
            'data' => SumberKeluhan::get()], 200);
    }

    // Store source complaint
    public function store(Request $request)
    {
        $id_sumber = $request->input('id_sumber');
        $sumber = $request->input('sumber');

        try {
            SumberKeluhan::create([
                'id_sumber' => $id_sumber,
                'sumber' => $sumber,
            ]);
            $message = 'Data Sumber Keluhan berhasil dimasukan';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = 'Error';
            $message = $th->getMessage();
            $http_code = 404;
        }
        return response()->json([
            'status'=>$status,
            'message' =>$message
        ],$http_code);
    }

    // Show source complaint
    public function show($id)
    {
        $sumber = SumberKeluhan::find($id);
        if (!$sumber) {
            $status = 'Error';
            $message = 'Source complaint not found';
            return response()->json([
                'status'=>$status,
                'message' =>$message
            ],404);
        }else{
            $message = 'Source complaint has found';
            $status = 'Success';
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' =>$sumber
            ],200);
        }
    }

    // Update source complaint
    public function update(Request $request, $id)
    {
        try {
            SumberKeluhan::find($id)->update([
                'id_sumber' => $request->id_sumber,
                'sumber' => $request->sumber,
            ]);
            $message = 'Source complaint updated successfully';
            $status = 'Success';
            $http_code = 200;
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

    // Delete source complaint
    public function destroy($id)
    {
        try {
            SumberKeluhan::find($id)->update([
                'deleted_at' => Carbon::now()]
            );
            $message = 'Deleted source complaint successfully';
            $status = 'Success';
            $http_code = 200;
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
}
