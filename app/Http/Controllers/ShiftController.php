<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    // Index function for get all shift time for daily report
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Load data Shift successfully',
            'data' => Shift::get()], 200);
    }

    // Store Shift function
    public function store(Request $request)
    {
        $shift = $request->input('shift');
        $mulai = $request->input('mulai');
        $selesai = $request->input('selesai');

        try {
            Shift::create([
                'shift' => $shift,
                'mulai' => $mulai,
                'selesai' => $selesai,

            ]);
            $message = 'Data Shift updated successfully';
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
        ], $http_code);
    }


    // Show Shift function
    public function show($id)
    {
        $shift = Shift::find($id);
        if (!$shift) {
            $status = 'Error';
            $message = 'Data Shift not found';
            $http_code = 404;
            return response()->json([
                'status'=>$status,
                'message' =>$message
            ],$http_code);
        }else{
            $message = 'Data Shift has found';
            $status = 'Success';
            $http_code = 200;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' =>$status
            ],$http_code);
        }
    }

    // Update Shift function
    public function update(Request $request, $id)
    {
        try {
            Shift::find($id)->update([
                'shift' => $request->shift,
                'mulai' => $request->mulai,
                'selesai' => $request->selesai,
            ]);
            $message = 'Data Shift updated successfully';
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

    // Delete Shift function
    public function destroy($id)
    {
        try {
            Shift::find($id)->delete();
            $message = 'Data Shift deleted successfully';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            $http_code = 404;
            return response()->json([
                'status'=>$status,
                'message' =>$message
            ],404);
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }
}
