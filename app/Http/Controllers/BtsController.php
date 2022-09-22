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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Load data post successfully',

            'data' => Bts::with(['user','pop'])->get()
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bts  $bts
     * @return \Illuminate\Http\Response
     */
    public function show($id_bts)
    {
        $message = "Load data post successfully";
        $status = "success";
        $bts = Bts::find($id_bts);

        if (!$bts) {
            $status = "error";
            $message = "Data post not found";
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            // 'data' => $bts::with('user')->get()], 200);
            'data' => $bts::with(['pop','user','user.role'])->where('pop_id', $id_bts)->where('user_id', $id_bts)->get()], 200);
            // 'data' => $bts::with('user')->where('user_id',$id_bts)->get()], 200);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bts  $bts
     * @return \Illuminate\Http\Response
     */
    public function edit(Bts $bts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bts  $bts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $message = 'Data updated successfully';
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bts  $bts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = 'Data deleted successfully';
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
