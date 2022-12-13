<?php

namespace App\Http\Controllers;
use App\Models\Bts;
use Illuminate\Http\Request;

class BtsController extends Controller
{
    // Enable if u need middleware in controller (not in route)
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Index function to get All BTS with POP
    public function index()
    {
        $bts = Bts::with('pop')->get();
        if($bts->isNotEmpty()) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Load data BTS successfully',
                'data' => $bts
            ], 200);
        }else{
            return response()->json([
                'status'=>'Failed',
                'mesage' =>'Data BTS not found'
            ],404);
        }
    }

    // Store BTS function
    public function store(Request $request)
    {
        $message = 'BTS added successfully';
        $status = 'Success';

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
            $status = 'Failed';
            $message = $th->getMessage();
        }

        return response([
            'status' => $status,
            'message' => $message,
        ], 200);
    }

    // Show BTS function
    public function show($id)
    {
        $message = "BTS found";
        $status = "Success";
        $bts = Bts::find($id);
        if (!$bts) {
            $status = "Error";
            $message = "BTS not found";
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

    // Update BTS function
    public function update(Request $request, $id)
    {
        $message = 'BTS updated successfully';
        $status = 'Success';

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

    // Delete BTS function
    public function destroy($id)
    {
        $message = 'BTS deleted successfully';
        $status = 'Success';
        try {
            Bts::find($id)->delete();
        } catch (\Throwable $th) {
            $status = "Error";
            $message = $th->getMessage();
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
    }
}
