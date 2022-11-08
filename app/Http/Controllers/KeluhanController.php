<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Carbon;
use App\Models\Keluhan;
use App\Models\RFO_Gangguan;
use App\Models\RFO_Keluhan;
use Illuminate\Http\Request;


class KeluhanController extends Controller
{
    public function index(){
        $today = Carbon::now()->format('Y-m-d');
        $data = Keluhan::where('status','open')
        ->orwhere([
            ['status','closed'],
            ['updated_at','iLIKE', "%{$today}%"],
        ])
        // Fungsi ini terlalu panjang
        // ->orWhere(function ($query) {
        //     $query->where('status', '=', 'closed')
        //           ->where('updated_at', 'LIKE', '%'.Carbon::now()->format('Y-m-d').'%');
        // })
        ->orderBy('created_at', 'DESC')->with('pop','balasan','RFO_Gangguan','RFO_Keluhan','lampirankeluhan')->get();
        if($data->isNotEmpty()){
            return response()->json([
                'status' => 'success',
                'message' => 'Data keluhan berhasil ditemukan',
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
        $data = Keluhan::where('status','=','closed')->orderBy('created_at', 'DESC')->with('pop','balasan')->paginate(10);;
        if($data->isNotEmpty()){
            return response()->json([
                'status' => 'success',
                'message' => 'Data history keluhan berhasil ditemukan',
                'data' => $data
            ], 200);
        }else{
            return response()->json([
                'status'=>"error",
                'mesage' =>"Data history keluhan tidak ditemukan"
            ],404);
        }
    }

    public function search(Request $request)
	{
        $search = $request->input('search');
        // Fungsi ini berhasil namun pencarian terbatas hanya Nama Pelanggan
        // $data = Keluhan::where('status','closed')
        // ->where('nama_pelanggan', 'iLIKE', "%{$search}%")
        // ->orWhere('nomor_pelapor', 'iLIKE', "%{$search}%")
        // ->get();

        // Fungsi ini berhasil melakukan pencarian lengkap yang statusnya closed
        $data = Keluhan::where([
            ['status', 'closed'],
            ['id_pelanggan', 'iLIKE', "%{$search}%"],
        ])->orwhere([
            ['status', 'closed'],
            ['nama_pelanggan', 'iLIKE', "%{$search}%"],
        ])->orwhere([
            ['status', 'closed'],
            ['nama_pelapor', 'iLIKE', "%{$search}%"],
        ])->orwhere([
            ['status', 'closed'],
            ['nomor_pelapor', 'iLIKE', "%{$search}%"],
        ])->orwhere([
            ['status', 'closed'],
            ['nomor_keluhan', $search],
        ])->orwhere([
            ['status', 'closed'],
            ['keluhan', 'iLIKE', "%{$search}%"],
        ])->paginate(10);

        if($data->isEmpty()){
            return response()->json([
                'status' => 'error',
                'message' => 'Data history keluhan tidak ditemukan',
            ], 404);
        }else{
            return response()->json([
                'status' => 'succes',
                'message' => 'Data history keluhan berhasil ditemukan',
                'data' => $data
            ], 200);
        }
    }

    public function store(Request $request){
        $message = 'Data keluhan berhasil dimasukan';
        $status = "success";
        // Format:
        // #T051102212345
        // # = hashtag
        // T = Trouble
        // date() = YYYY-MM-DD
        // Random Interger = 5 Digit

        $id_pelanggan = $request->input('id_pelanggan');
        $nama_pelanggan = $request->input('nama_pelanggan');
        $nama_pelapor = $request->input('nama_pelapor');
        $nomor_pelapor = $request->input('nomor_pelapor');
        $nomor_keluhan = '#T'.date("Ymd").rand( 10000 , 99999 );
        $sumber_id = $request->input('sumber_id');
        $detail_sumber = $request->input('detail_sumber');
        $keluhan = $request->input('keluhan');
        $status_keluhan = $request->input('status');
        $pop_id = $request->input('pop_id');
        $user_id = $request->input('user_id');
        $rfo_gangguan_id = $request->input('rfo_gangguan_id');
        $rfo_keluhan_id = $request->input('rfo_keluhan_id');

        try {
            Keluhan::create([
                'id_pelanggan' => $id_pelanggan,
                'nama_pelanggan' => $nama_pelanggan,
                'nama_pelapor' => $nama_pelapor,
                'nomor_pelapor' => $nomor_pelapor,
                'nomor_keluhan' => $nomor_keluhan,
                'sumber_id' => $sumber_id,
                'detail_sumber' => $detail_sumber,
                'keluhan' => $keluhan,
                'status' => $status_keluhan,
                'lampiran' => $lampiran,
                'pop_id' => $pop_id,
                'user_id' => $user_id,
                'rfo_gangguan_id'> $rfo_gangguan_id,
                'rfo_keluhan_id'> $rfo_keluhan_id,
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
        $message = "Data Keluhan berhasil ditemukan";
        $status = "success";
        $keluhan = Keluhan::find($id);
        try {
            if (!$keluhan) {
                $status = "error";
                $message = "Data Keluhan tidak ditemukan";
                return response()->json([
                    'status'=>$status,
                    'mesage' =>$message
                ],404);
            }else{
                $keluhan->user;
                $keluhan->pop;
                $keluhan->balasan;
                $keluhan->lampirankeluhan;
                $keluhan->rfo_keluhan;
                $keluhan->rfo_gangguan;
                return response()->json([
                    'status' => $status,
                    'message' => $message,
                    'data' =>$keluhan,
                ],200);
            }
        } catch (\Throwable $th) {
            $status = "error";
            $message = $th->getMessage();
            return response()->json([
                'status' => $status,
                'message' => $message,
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        $message = 'Data keluhan berhasil diupdate';
        $status = "success";

        try {
            Keluhan::find($id)->update([
                'pop_id' => $request->pop_id,
                'nama_pelapor' => $request->nama_pelapor,
                'nomor_pelapor' => $request->nomor_pelapor,
                'sumber_id' => $request->sumber_id,
                'detail_sumber' => $request->detail_sumber,
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

    public function close(Request $request, $id)
    {
        $message = 'Data keluhan berhasil ditutup';
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

    public function updateKeluhanRFOGangguan(Request $request, $id)
    {
        $message = 'Data keluhan RFO Gangguan berhasil diupdate';
        $status = "success";

        try {
            Keluhan::find($id)->update([
                'rfo_gangguan_id' => $request->rfo_gangguan_id,
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

    public function updateKeluhanRFOKeluhan(Request $request, $id)
    {
        $message = 'Data keluhan RFO Keluhan berhasil diupdate';
        $status = "success";

        try {
            Keluhan::find($id)->update([
                'rfo_keluhan_id' => $request->rfo_keluhan_id,
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
        $message = 'Data keluhan berhasil dibuka';
        $status = "success";
        $keluhan = Keluhan::find($id);
        if (!empty($keluhan)){
            try {
                $keluhan->update([
                    'status' => $request->status_keluhan='open',
                    'rfo_gangguan_id' => $request->rfo_gangguan=null,
                    'rfo_keluhan_id' => $request->rfo_keluhan=null,
                ]);
            } catch (\Throwable $th) {
                $status = "error";
                $message = $th->getMessage();
            }
        }else{
            $message = 'Data keluhan tidak ditemukan';
            $status = "success";
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ], 200);
        // Fungsi DB Transacsion ini masih gagal wqwqwq
        // Revisi: Buat ID RFO Gangguan dan RFO Keluhan delete
        // 'rfo_gangguan_id'=>$request->rfo_gangguan_id=null,
        // 'rfo_keluhan_id'=>$request->rfo_gangguan_id=null,
        // $rfo_gangguan = $keluhan["rfo_gangguan_id"];
        // $RFOGangguan = RFO_Gangguan::find($rfo_gangguan);
        // $RFOKeluhan = RFO_Keluhan::find($rfo_keluhan);
        // dd($RFOKeluhan);
        // DB::beginTransaction();
        // try {
        //     $keluhan = Keluhan::find($id);
        //     $keluhan->update([
        //         'status' => $request->status_keluhan='open',

        //     ]);
        //     $rfo_keluhan = $keluhan["rfo_keluhan_id"];
        //     if(!empty($rfo_keluhan)){
        //         RFO_Keluhan::find($rfo_keluhan)->delete();
        //     }

        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     $status = "error";
        //     $message = $e->getMessage();
        // }

    }

    public function destroy($id)
    {
        $message = 'Data keluhan berhasil dihapus';
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
