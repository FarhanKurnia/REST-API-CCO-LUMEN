<?php

namespace App\Http\Controllers;

use App\Models\Pop;
use Illuminate\Http\Request;
use Carbon\Carbon;


class POPController extends Controller
{
    // Index function to get All POP
    public function index()
    {
        $pop = POP::where('deleted_at',null)->get();
        return response()->json([
            'status' => 'Success',
            'message' => 'Load all data POP successfully',
            'data' => $pop], 200);
    }

    // Store POP function
    public function store(Request $request)
    {
        $id_pop = $request->input('id_pop');
        $pop = $request->input('pop');

        try {
            POP::create([
                'id_pop' => $id_pop,
                'pop' => $pop,
            ]);
            $message = 'POP added successfully';
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

    // Show POP function
    public function show($id)
    {
        $pop = POP::find($id);
        if (!$pop) {
            $status = 'Error';
            $message = 'POP not found';
            $http_code = 404;
            return response()->json([
                'status'=>$status,
                'message' =>$message
            ],$http_code);
        }else{
            $message = 'POP has found';
            $status = 'Success';
            $http_code = 200;
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' =>$pop
            ],$http_code);
        }
    }

    // Update POP function
    public function update(Request $request, $id)
    {
        try {
            POP::find($id)->update([
                'id_pop' => $request->id_pop,
                'pop' => $request->pop,
            ]);
            $message = 'POP updated successfully';
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

    // Delete POP function
    public function destroy($id)
    {
        try {
            POP::find($id)->update([
                'deleted_at' => Carbon::now()]
            );
            $message = 'POP deleted successfully';
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
