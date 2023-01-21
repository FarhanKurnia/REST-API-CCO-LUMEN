<?php

namespace App\Http\Controllers;
use App\Models\Bts;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library



class BtsController extends Controller
{
    // Enable if u need middleware in controller (not in route)
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Index function to get All BTS with POP
    public function index(Request $request)
    {
        $pop_id = $request->get('pop_id');
        $keyword = $request->get('keyword');
        if($pop_id==null && $keyword==null){
            
        }

        if ($pop_id == null) {
            $data = BTS::where([
                ['nama_bts','iLike',$keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['lokasi','iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->with('pop')->get();

            if($data->isEmpty()){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data BTS not found',
                ], 404);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data BTS has found',
                    'data' => $data
                ], 200);
            }
        }else{
            $data = BTS::where([
                ['nama_bts','iLike',$keyword],
                ['pop_id',$pop_id],
                ['deleted_at',null]
            ])->orwhere([
                ['lokasi','iLIKE', "%{$keyword}%"],
                ['pop_id',$pop_id],
                ['deleted_at',null]
            ])->with('pop')->paginate();

            if($data->isEmpty()){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data BTS not found',
                ], 404);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data BTS has found',
                    'data' => $data
                ], 200);
            }
        }



        $bts = Bts::where('deleted_at',null)->with('pop')->paginate(10);
        if($bts->isNotEmpty()) {
            return response()->json([
                'status' => 'Success',
                'message' => 'Load data BTS successfully',
                'data' => $bts
            ], 200);
        }else{
            return response()->json([
                'status'=>'Failed',
                'message' =>'Data BTS not found'
            ],404);
        }
    }

    // Store BTS function
    public function store(Request $request)
    {
        $token = JWTAuth::getToken();
        $jwt_id = JWTAuth::getPayload($token)->toArray();
        $id_user = $jwt_id['id_user'];

        $nama_bts = $request->input('nama_bts');
        $nama_pic = $request->input('nama_pic');
        $nomor_pic = $request->input('nomor_pic');
        $lokasi = $request->input('lokasi');
        $pop_id = $request->input('pop_id');
        $kordinat = $request->input('kordinat');
        $deskripsi = $request->input('deskripsi');

        try {
            Bts::create([
                'nama_bts' => $nama_bts,
                'nama_pic' => $nama_pic,
                'nomor_pic' => $nomor_pic,
                'lokasi' => $lokasi,
                'pop_id' => $pop_id,
                'kordinat' => $kordinat,
                'user_id' => $id_user,
                'deskripsi' => $deskripsi,
            ]);
            $message = 'BTS added successfully';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = 'Failed';
            $message = $th->getMessage();
            $http_code = 404;
        }

        return response([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }

    // Search BTS 
    public function search(Request $request)
	{
        $pop_id = $request->get('pop_id');
        $keyword = $request->get('keyword');
        if ($pop_id == null) {
            $data = BTS::where([
                ['nama_bts','iLike',$keyword],
                ['deleted_at',null]
            ])->orwhere([
                ['lokasi','iLIKE', "%{$keyword}%"],
                ['deleted_at',null]
            ])->with('pop')->get();

            if($data->isEmpty()){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data BTS not found',
                ], 404);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data BTS has found',
                    'data' => $data
                ], 200);
            }
        }else{
            $data = BTS::where([
                ['nama_bts','iLike',$keyword],
                ['pop_id',$pop_id],
                ['deleted_at',null]
            ])->orwhere([
                ['lokasi','iLIKE', "%{$keyword}%"],
                ['pop_id',$pop_id],
                ['deleted_at',null]
            ])->with('pop')->paginate();

            if($data->isEmpty()){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data BTS not found',
                ], 404);
            }else{
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data BTS has found',
                    'data' => $data
                ], 200);
            }
        }
    }    

    // Show BTS function
    public function show($id)
    {
        $bts = Bts::find($id);
        if (!$bts) {
            $status = "Error";
            $message = "BTS not found";
            return response()->json([
                'status'=>$status,
                'message' =>$message
            ],404);
        }else{
            $bts->user;
            $bts->user->role;
            $bts->user->pop;
            $bts->pop;
            $message = "BTS found";
            $status = "Success";
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
        try {
            Bts::find($id)->update([
                'nama_bts' => $request->nama_bts,
                'nama_pic' => $request->nama_pic,
                'nomor_pic' => $request->nomor_pic,
                'lokasi' => $request->lokasi,
                'pop_id' => $request->pop_id,
                'kordinat' => $request->kordinat,
                'deskripsi' => $request->deskripsi,
            ]);
            $message = 'BTS updated successfully';
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

    // Delete BTS function
    public function destroy($id)
    {
        try {
            Bts::find($id)->update([
                'deleted_at' => Carbon::now()
            ]);
            $message = 'BTS deleted successfully';
            $status = 'Success';
            $http_code = 200;
        } catch (\Throwable $th) {
            $status = "Error";
            $message = $th->getMessage();
            $http_code = 404;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
        ], $http_code);
    }
}
