<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Keluhan;
use App\Models\RFO_Gangguan;
use App\Models\RFO_Keluhan;

class Statistik extends Controller
{
    public function index(){
        // $plot = Carbon::create($this_year, $this_month);
        $today = Carbon::today()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $a_week_ago = Carbon::today()->addWeek(-1);
        $this_month = Carbon::today()->addMonth(0)->format('Y-m');
        $this_year = Carbon::today()->addYears(0)->format('Y');
        $januari = Carbon::create($this_year, 1)->format('Y-m');
        $februari = Carbon::create($this_year, 2)->format('Y-m');
        $maret = Carbon::create($this_year, 3)->format('Y-m');
        $april = Carbon::create($this_year, 4)->format('Y-m');
        $mei = Carbon::create($this_year, 5)->format('Y-m');
        $juni = Carbon::create($this_year, 6)->format('Y-m');
        $juli = Carbon::create($this_year, 7)->format('Y-m');
        $agustus = Carbon::create($this_year, 8)->format('Y-m');
        $september = Carbon::create($this_year, 9)->format('Y-m');
        $oktober = Carbon::create($this_year, 10)->format('Y-m');
        $november = Carbon::create($this_year, 11)->format('Y-m');
        $desember = Carbon::create($this_year, 12)->format('Y-m');
        // dd($this_month);

        // Object
        $keluhan = new Keluhan;
        $rfo_keluhan = new RFO_Keluhan;
        $rfo_gangguan = new RFO_Gangguan();

        //Semua Keluhan dan RFO
        $all_case = $keluhan->count();
        $all_case_closed = $keluhan->where('status','closed')->count();
        $all_case_opened = $keluhan->where('status','open')->count();
        $all_rfo_keluhan = $rfo_keluhan->count();
        $all_rfo_gangguan = $rfo_gangguan->count();

        //Semua Keluhan Jogja
        $all_case_jogja = $keluhan->where('pop_id',1)->count();
        $all_case_closed_jogja = $keluhan->where([
            ['pop_id',1],
            ['status','closed'],
            ])->count();
        $all_case_opened_jogja = $keluhan->where([
            ['pop_id',1],
            ['status','open'],
            ])->count();

        //Semua Keluhan Solo
        $all_case_solo = $keluhan->where('pop_id',2)->count();
        $all_case_closed_solo = $keluhan->where([
            ['pop_id',2],
            ['status','closed'],
            ])->count();
        $all_case_opened_solo = $keluhan->where([
            ['pop_id',2],
            ['status','open'],
            ])->count();

        //Semua Keluhan Purwokerto
        $all_case_purwokerto = $keluhan->where('pop_id',3)->count();
        $all_case_closed_purwokerto = $keluhan->where([
            ['pop_id',3],
            ['status','closed'],
            ])->count();
        $all_case_opened_purwokerto = $keluhan->where([
            ['pop_id',3],
            ['status','open'],
            ])->count();

        // Semua Keluhan Hari ini
        $all_case_today = $keluhan->where('created_at','LIKE',"%{$today}%")->count();
        $all_case_closed_today = $keluhan->where([
            ['status','closed'],
            ['updated_at','iLIKE',"%{$today}%"]
            ])->count();
        $all_case_opened_today = $keluhan->where([
            ['status','open'],
            ['created_at','iLIKE',"%{$today}%"]
            ])->count();
        $all_rfo_keluhan_today = $rfo_keluhan->where('created_at','LIKE',"%{$today}%")->count();
        $all_rfo_gangguan_today = $rfo_gangguan->where('created_at','LIKE',"%{$today}%")->count();

        // Semua Keluhan Hari ini Jogja
        $all_case_jogja_today = $keluhan->where([['pop_id',1],['created_at','LIKE',"%{$today}%"]])->count();
        $all_case_closed_jogja_today = $keluhan->where([
            ['pop_id',1],
            ['status','closed'],
            ['updated_at','iLIKE',"%{$today}%"]
            ])->count();
        $all_case_opened_jogja_today = $keluhan->where([
            ['pop_id',1],
            ['status','open'],
            ['created_at','iLIKE',"%{$today}%"]
            ])->count();

        // Semua Keluhan Hari ini Solo
        $all_case_solo_today = $keluhan->where([['pop_id',2],['created_at','LIKE',"%{$today}%"]])->count();
        $all_case_closed_solo_today = $keluhan->where([
            ['pop_id',2],
            ['status','closed'],
            ['updated_at','iLIKE',"%{$today}%"]
            ])->count();
        $all_case_opened_solo_today = $keluhan->where([
            ['pop_id',2],
            ['status','open'],
            ['created_at','iLIKE',"%{$today}%"]
            ])->count();

        // Semua Keluhan Hari ini purwokerto
        $all_case_purwokerto_today = $keluhan->where([['pop_id',3],['created_at','LIKE',"%{$today}%"]])->count();
        $all_case_closed_purwokerto_today = $keluhan->where([
            ['pop_id',3],
            ['status','closed'],
            ['updated_at','iLIKE',"%{$today}%"]
            ])->count();
        $all_case_opened_purwokerto_today = $keluhan->where([
            ['pop_id',3],
            ['status','open'],
            ['created_at','iLIKE',"%{$today}%"]
            ])->count();

        // Semua Keluhan kemarin
        $all_case_yesterday = $keluhan->where('created_at','LIKE',"%{$yesterday}%")->count();
        $all_case_closed_yesterday = $keluhan->where([
            ['status','closed'],
            ['updated_at','iLIKE',"%{$yesterday}%"]
            ])->count();
        $all_case_opened_yesterday = $keluhan->where([
            ['status','open'],
            ['created_at','iLIKE',"%{$yesterday}%"]
            ])->count();
        $all_rfo_keluhan_yesterday = $rfo_keluhan->where('created_at','LIKE',"%{$yesterday}%")->count();
        $all_rfo_gangguan_yesterday = $rfo_gangguan->where('created_at','LIKE',"%{$yesterday}%")->count();

        // Semua Keluhan Kemarin Jogja
        $all_case_jogja_yesterday = $keluhan->where([['pop_id',1],['created_at','LIKE',"%{$yesterday}%"]])->count();
        $all_case_closed_jogja_yesterday = $keluhan->where([
            ['pop_id',1],
            ['status','closed'],
            ['updated_at','iLIKE',"%{$yesterday}%"]
            ])->count();
        $all_case_opened_jogja_yesterday = $keluhan->where([
            ['pop_id',1],
            ['status','open'],
            ['created_at','iLIKE',"%{$yesterday}%"]
            ])->count();

        // Semua Keluhan Kemarin Solo
        $all_case_solo_yesterday = $keluhan->where([['pop_id',2],['created_at','LIKE',"%{$yesterday}%"]])->count();
        $all_case_closed_solo_yesterday = $keluhan->where([
            ['pop_id',2],
            ['status','closed'],
            ['updated_at','iLIKE',"%{$yesterday}%"]
            ])->count();
        $all_case_opened_solo_yesterday = $keluhan->where([
            ['pop_id',2],
            ['status','open'],
            ['created_at','iLIKE',"%{$yesterday}%"]
            ])->count();

        // Semua Keluhan Kemarin purwokerto
        $all_case_purwokerto_yesterday = $keluhan->where([['pop_id',3],['created_at','LIKE',"%{$yesterday}%"]])->count();
        $all_case_closed_purwokerto_yesterday = $keluhan->where([
            ['pop_id',3],
            ['status','closed'],
            ['updated_at','iLIKE',"%{$yesterday}%"]
            ])->count();
        $all_case_opened_purwokerto_yesterday = $keluhan->where([
            ['pop_id',3],
            ['status','open'],
            ['created_at','iLIKE',"%{$yesterday}%"]
            ])->count();

        // Semua Keluhan Seminggu kemarin
        $all_case_a_week_ago = $keluhan->where('created_at','LIKE',"%{$a_week_ago}%")->count();
        $all_case_closed_a_week_ago = $keluhan->where([
            ['status','closed'],
            ['updated_at','iLIKE',"%{$a_week_ago}%"]
            ])->count();
        $all_case_opened_a_week_ago = $keluhan->where([
            ['status','open'],
            ['created_at','iLIKE',"%{$a_week_ago}%"]
            ])->count();
        $all_rfo_keluhan_a_week_ago = $rfo_keluhan->where('created_at','LIKE',"%{$a_week_ago}%")->count();
        $all_rfo_gangguan_a_week_ago = $rfo_gangguan->where('created_at','LIKE',"%{$a_week_ago}%")->count();

        // Semua Keluhan Seminggu Kemarin Jogja
        $all_case_jogja_a_week_ago = $keluhan->where([['pop_id',1],['created_at','LIKE',"%{$a_week_ago}%"]])->count();
        $all_case_closed_jogja_a_week_ago = $keluhan->where([
            ['pop_id',1],
            ['status','closed'],
            ['updated_at','iLIKE',"%{$a_week_ago}%"]
            ])->count();
        $all_case_opened_jogja_a_week_ago = $keluhan->where([
            ['pop_id',1],
            ['status','open'],
            ['created_at','iLIKE',"%{$a_week_ago}%"]
            ])->count();

        // Semua Keluhan Seminggu Kemarin Solo
        $all_case_solo_a_week_ago = $keluhan->where([['pop_id',2],['created_at','LIKE',"%{$a_week_ago}%"]])->count();
        $all_case_closed_solo_a_week_ago = $keluhan->where([
            ['pop_id',2],
            ['status','closed'],
            ['updated_at','iLIKE',"%{$a_week_ago}%"]
            ])->count();
        $all_case_opened_solo_a_week_ago = $keluhan->where([
            ['pop_id',2],
            ['status','open'],
            ['created_at','iLIKE',"%{$a_week_ago}%"]
            ])->count();

        // Semua Keluhan Seminggu Kemarin purwokerto
        $all_case_purwokerto_a_week_ago = $keluhan->where([['pop_id',3],['created_at','LIKE',"%{$a_week_ago}%"]])->count();
        $all_case_closed_purwokerto_a_week_ago = $keluhan->where([
            ['pop_id',3],
            ['status','closed'],
            ['updated_at','iLIKE',"%{$a_week_ago}%"]
            ])->count();
        $all_case_opened_purwokerto_a_week_ago = $keluhan->where([
            ['pop_id',3],
            ['status','open'],
            ['created_at','iLIKE',"%{$a_week_ago}%"]
            ])->count();

        // Semua Keluhan Bulan ini
        $all_case_this_month = $keluhan->where('created_at','LIKE',"%{$this_month}%")->count();
        $all_case_jogja_this_month = $keluhan->where([
            ['pop_id',1],
            ['created_at','LIKE',"%{$this_month}%"]
            ])->count();
        $all_case_solo_this_month = $keluhan->where([
            ['pop_id',2],
            ['created_at','LIKE',"%{$this_month}%"]
            ])->count();
        $all_case_purwokerto_this_month = $keluhan->where([
            ['pop_id',3],
            ['created_at','LIKE',"%{$this_month}%"]
            ])->count();
        $all_rfo_keluhan_this_month = $rfo_keluhan->where('created_at','LIKE',"%{$this_month}%")->count();
        $all_rfo_gangguan_this_month = $rfo_gangguan->where('created_at','LIKE',"%{$this_month}%")->count();

        // Semua Keluhan setahun ini
        // Januari
        $all_case_januari = $keluhan->where('created_at','LIKE',"%{$januari}%")->count();
        $all_case_januari_jogja = $keluhan->where([
            ['pop_id',1],
            ['created_at','LIKE',"%{$januari}%"]
            ])->count();
        $all_case_januari_solo = $keluhan->where([
            ['pop_id',2],
            ['created_at','LIKE',"%{$januari}%"]
            ])->count();
        $all_case_januari_purwokerto = $keluhan->where([
            ['pop_id',3],
            ['created_at','LIKE',"%{$januari}%"]
            ])->count();
        // Februari
        $all_case_februari = $keluhan->where('created_at','LIKE',"%{$februari}%")->count();
        $all_case_februari_jogja = $keluhan->where([
            ['pop_id',1],
            ['created_at','LIKE',"%{$februari}%"]
            ])->count();
        $all_case_februari_solo = $keluhan->where([
            ['pop_id',2],
            ['created_at','LIKE',"%{$februari}%"]
            ])->count();
        $all_case_februari_purwokerto = $keluhan->where([
            ['pop_id',3],
            ['created_at','LIKE',"%{$februari}%"]
            ])->count();
        // Maret
        $all_case_maret = $keluhan->where('created_at','LIKE',"%{$maret}%")->count();
        $all_case_maret_jogja = $keluhan->where([
            ['pop_id',1],
            ['created_at','LIKE',"%{$maret}%"]
            ])->count();
        $all_case_maret_solo = $keluhan->where([
            ['pop_id',2],
            ['created_at','LIKE',"%{$maret}%"]
            ])->count();
        $all_case_maret_purwokerto = $keluhan->where([
            ['pop_id',3],
            ['created_at','LIKE',"%{$maret}%"]
            ])->count();
        // April
        $all_case_april = $keluhan->where('created_at','LIKE',"%{$april}%")->count();
        $all_case_april_jogja = $keluhan->where([
            ['pop_id',1],
            ['created_at','LIKE',"%{$april}%"]
            ])->count();
        $all_case_april_solo = $keluhan->where([
            ['pop_id',2],
            ['created_at','LIKE',"%{$april}%"]
            ])->count();
        $all_case_april_purwokerto = $keluhan->where([
            ['pop_id',3],
            ['created_at','LIKE',"%{$april}%"]
            ])->count();
        // Mei
        $all_case_mei = $keluhan->where('created_at','LIKE',"%{$mei}%")->count();
        $all_case_mei_jogja = $keluhan->where([
            ['pop_id',1],
            ['created_at','LIKE',"%{$mei}%"]
            ])->count();
        $all_case_mei_solo = $keluhan->where([
            ['pop_id',2],
            ['created_at','LIKE',"%{$mei}%"]
            ])->count();
        $all_case_mei_purwokerto = $keluhan->where([
            ['pop_id',3],
            ['created_at','LIKE',"%{$mei}%"]
            ])->count();
        // Juni
        $all_case_juni = $keluhan->where('created_at','LIKE',"%{$juni}%")->count();
        $all_case_juni_jogja = $keluhan->where([
            ['pop_id',1],
            ['created_at','LIKE',"%{$juni}%"]
            ])->count();
        $all_case_juni_solo = $keluhan->where([
            ['pop_id',2],
            ['created_at','LIKE',"%{$juni}%"]
            ])->count();
        $all_case_juni_purwokerto = $keluhan->where([
            ['pop_id',3],
            ['created_at','LIKE',"%{$juni}%"]
            ])->count();
         // Juli
         $all_case_juli = $keluhan->where('created_at','LIKE',"%{$juli}%")->count();
         $all_case_juli_jogja = $keluhan->where([
             ['pop_id',1],
             ['created_at','LIKE',"%{$juli}%"]
             ])->count();
         $all_case_juli_solo = $keluhan->where([
             ['pop_id',2],
             ['created_at','LIKE',"%{$juli}%"]
             ])->count();
         $all_case_juli_purwokerto = $keluhan->where([
             ['pop_id',3],
             ['created_at','LIKE',"%{$juli}%"]
             ])->count();
        // Agustus
         $all_case_agustus = $keluhan->where('created_at','LIKE',"%{$agustus}%")->count();
         $all_case_agustus_jogja = $keluhan->where([
             ['pop_id',1],
             ['created_at','LIKE',"%{$agustus}%"]
             ])->count();
         $all_case_agustus_solo = $keluhan->where([
             ['pop_id',2],
             ['created_at','LIKE',"%{$agustus}%"]
             ])->count();
         $all_case_agustus_purwokerto = $keluhan->where([
             ['pop_id',3],
             ['created_at','LIKE',"%{$agustus}%"]
             ])->count();
        // September
         $all_case_september = $keluhan->where('created_at','LIKE',"%{$september}%")->count();
         $all_case_september_jogja = $keluhan->where([
             ['pop_id',1],
             ['created_at','LIKE',"%{$september}%"]
             ])->count();
         $all_case_september_solo = $keluhan->where([
             ['pop_id',2],
             ['created_at','LIKE',"%{$september}%"]
             ])->count();
         $all_case_september_purwokerto = $keluhan->where([
             ['pop_id',3],
             ['created_at','LIKE',"%{$september}%"]
             ])->count();
        // Oktober
         $all_case_oktober = $keluhan->where('created_at','LIKE',"%{$oktober}%")->count();
         $all_case_oktober_jogja = $keluhan->where([
             ['pop_id',1],
             ['created_at','LIKE',"%{$oktober}%"]
             ])->count();
         $all_case_oktober_solo = $keluhan->where([
             ['pop_id',2],
             ['created_at','LIKE',"%{$oktober}%"]
             ])->count();
         $all_case_oktober_purwokerto = $keluhan->where([
             ['pop_id',3],
             ['created_at','LIKE',"%{$oktober}%"]
             ])->count();
        // November
         $all_case_november = $keluhan->where('created_at','LIKE',"%{$november}%")->count();
         $all_case_november_jogja = $keluhan->where([
             ['pop_id',1],
             ['created_at','LIKE',"%{$november}%"]
             ])->count();
         $all_case_november_solo = $keluhan->where([
             ['pop_id',2],
             ['created_at','LIKE',"%{$november}%"]
             ])->count();
         $all_case_november_purwokerto = $keluhan->where([
             ['pop_id',3],
             ['created_at','LIKE',"%{$november}%"]
             ])->count();
        // Desember
        $all_case_desember = $keluhan->where('created_at','LIKE',"%{$desember}%")->count();
        $all_case_desember_jogja = $keluhan->where([
            ['pop_id',1],
            ['created_at','LIKE',"%{$desember}%"]
            ])->count();
        $all_case_desember_solo = $keluhan->where([
            ['pop_id',2],
            ['created_at','LIKE',"%{$desember}%"]
            ])->count();
        $all_case_desember_purwokerto = $keluhan->where([
            ['pop_id',3],
            ['created_at','LIKE',"%{$desember}%"]
            ])->count();

        return response()->json([
            'status' => 'success',
            'message' => 'Data keluhan berhasil ditemukan',
            'all' => [
                [
                    'Nama' => 'Semua POP',
                    'Semua_Keluhan' => $all_case,
                    'Semua_Keluhan_Closed' => $all_case_closed,
                    'Semua_Keluhan_Open' => $all_case_opened,
                    'Semua_RFO_Keluhan' => $all_rfo_keluhan,
                    'Semua_RFO_Gangguan' => $all_rfo_gangguan,
                ],
                [
                    'Nama' => 'Yogyakarta',
                    'Semua_Keluhan' => $all_case_jogja,
                    'Semua_Keluhan_Closed' => $all_case_closed_jogja,
                    'Semua_Keluhan_Open' => $all_case_opened_jogja,
                ],
                [
                    'Nama' => 'Surakarta',
                    'Semua_Keluhan' => $all_case_solo,
                    'Semua_Keluhan_Closed' => $all_case_closed_solo,
                    'Semua_Keluhan_Open' => $all_case_opened_solo,
                ],
                [
                    'Nama' => 'Purwokerto',
                    'Semua_Keluhan' => $all_case_purwokerto,
                    'Semua_Keluhan_Closed' => $all_case_closed_purwokerto,
                    'Semua_Keluhan_Open' => $all_case_opened_purwokerto,
                ],
            ],
            'today' => [
                [
                    'Nama' => 'Semua POP',
                    'Semua_Keluhan' => $all_case_today,
                    'Semua_Keluhan_Closed' => $all_case_closed_today,
                    'Semua_Keluhan_Open' => $all_case_opened_today,
                    'Semua_RFO_Keluhan' => $all_rfo_keluhan_today,
                    'Semua_RFO_Gangguan' => $all_rfo_gangguan_today,
                ],
                [
                    'Nama' => 'Yogyakarta',
                    'Semua_Keluhan' => $all_case_jogja_today,
                    'Semua_Keluhan_Closed' => $all_case_closed_jogja_today,
                    'Semua_Keluhan_Open' => $all_case_opened_jogja_today,
                ],
                [
                    'Nama' => 'Surakarta',
                    'Semua_Keluhan' => $all_case_solo_today,
                    'Semua_Keluhan_Closed' => $all_case_closed_solo_today,
                    'Semua_Keluhan_Open' => $all_case_opened_solo_today,
                ],
                [
                    'Nama' => 'Purwokerto',
                    'Semua_Keluhan' => $all_case_purwokerto_today,
                    'Semua_Keluhan_Closed' => $all_case_closed_purwokerto_today,
                    'Semua_Keluhan_Open' => $all_case_opened_purwokerto_today,
                ],

            ],
            'yesterday' => [
                [
                    'Nama' => 'Semua POP',
                    'Semua_Keluhan' => $all_case_yesterday,
                    'Semua_Keluhan_Closed' => $all_case_closed_yesterday,
                    'Semua_Keluhan_Open' => $all_case_opened_yesterday,
                    'Semua_RFO_Keluhan' => $all_rfo_keluhan_yesterday,
                    'Semua_RFO_Gangguan' => $all_rfo_gangguan_yesterday,
                ],
                [
                    'Nama' => 'Yogyakarta',
                    'Semua_Keluhan' => $all_case_jogja_yesterday,
                    'Semua_Keluhan_Closed' => $all_case_closed_jogja_yesterday,
                    'Semua_Keluhan_Open' => $all_case_opened_jogja_yesterday,
                ],
                [
                    'Nama' => 'Surakarta',
                    'Semua_Keluhan' => $all_case_solo_yesterday,
                    'Semua_Keluhan_Closed' => $all_case_closed_solo_yesterday,
                    'Semua_Keluhan_Open' => $all_case_opened_solo_yesterday,
                ],
                [
                    'Nama' => 'Purwokerto',
                    'Semua_Keluhan' => $all_case_purwokerto_yesterday,
                    'Semua_Keluhan_Closed' => $all_case_closed_purwokerto_yesterday,
                    'Semua_Keluhan_Open' => $all_case_opened_purwokerto_yesterday,
                ],
            ],
            'a_week_ago' => [
                [
                    'Nama' => 'Semua POP',
                    'Semua_Keluhan' => $all_case_a_week_ago,
                    'Semua_Keluhan_Closed' => $all_case_closed_a_week_ago,
                    'Semua_Keluhan_Open' => $all_case_opened_a_week_ago,
                    'Semua_RFO_Keluhan' => $all_rfo_keluhan_a_week_ago,
                    'Semua_RFO_Gangguan' => $all_rfo_gangguan_a_week_ago,
                ],
                [
                    'Nama' => 'Yogyakarta',
                    'Semua_Keluhan' => $all_case_jogja_a_week_ago,
                    'Semua_Keluhan_Closed' => $all_case_closed_jogja_a_week_ago,
                    'Semua_Keluhan_Open' => $all_case_opened_jogja_a_week_ago,
                ],
                [
                    'Nama' => 'Surakarta',
                    'Semua_Keluhan' => $all_case_solo_a_week_ago,
                    'Semua_Keluhan_Closed' => $all_case_closed_solo_a_week_ago,
                    'Semua_Keluhan_Open' => $all_case_opened_solo_a_week_ago,
                ],
                [
                    'Nama' => 'Purwokerto',
                    'Semua_Keluhan' => $all_case_purwokerto_a_week_ago,
                    'Semua_Keluhan_Closed' => $all_case_closed_purwokerto_a_week_ago,
                    'Semua_Keluhan_Open' => $all_case_opened_purwokerto_a_week_ago,
                ],
            ],
            'this_month'=> [
                [
                    'Nama' => 'Semua Keluhan Sebulan',
                    'Total' => $all_case_this_month,
                ],
                [
                    'Nama' => 'Semua Keluhan Sebulan Yogyakarta',
                    'Total' => $all_case_jogja_this_month,
                ],
                [
                    'Nama' => 'Semua Keluhan Sebulan Surakarta',
                    'Total' => $all_case_solo_this_month,
                ],
                [
                    'Nama' => 'Semua Keluhan Sebulan Purwokerto',
                    'Total' => $all_case_purwokerto_this_month,
                ],
                [
                    'Nama' => 'Semua RFO Keluhan Sebulan',
                    'Total' => $all_rfo_keluhan_this_month,
                ],
                [
                    'Nama' => 'Semua RFO Gangguan Sebulan',
                    'Total' => $all_rfo_gangguan_this_month,
                ],
            ],
            'this_year'=> [
                [
                    'Nama' => 'Januari',
                    'Semua POP' => $all_case_januari,
                    'Yogyakarta' => $all_case_januari_jogja,
                    'Surakarta' => $all_case_januari_solo,
                    'Purwokerto' => $all_case_januari_purwokerto
                ],
                [
                    'Nama' => 'Februari',
                    'Semua POP' => $all_case_februari,
                    'Yogyakarta' => $all_case_februari_jogja,
                    'Surakarta' => $all_case_februari_solo,
                    'Purwokerto' => $all_case_februari_purwokerto
                ],
                [
                    'Nama' => 'Maret',
                    'Semua POP' => $all_case_maret,
                    'Yogyakarta' => $all_case_maret_jogja,
                    'Surakarta' => $all_case_maret_solo,
                    'Purwokerto' => $all_case_maret_purwokerto
                ],
                [
                    'Nama' => 'April',
                    'Semua POP' => $all_case_april,
                    'Yogyakarta' => $all_case_april_jogja,
                    'Surakarta' => $all_case_april_solo,
                    'Purwokerto' => $all_case_april_purwokerto
                ],
                [
                    'Nama' => 'April',
                    'Semua POP' => $all_case_mei,
                    'Yogyakarta' => $all_case_mei_jogja,
                    'Surakarta' => $all_case_mei_solo,
                    'Purwokerto' => $all_case_mei_purwokerto
                ],
                [
                    'Nama' => 'Juni',
                    'Semua POP' => $all_case_juni,
                    'Yogyakarta' => $all_case_juni_jogja,
                    'Surakarta' => $all_case_juni_solo,
                    'Purwokerto' => $all_case_juni_purwokerto
                ],
                [
                    'Nama' => 'Juli',
                    'Semua POP' => $all_case_juli,
                    'Yogyakarta' => $all_case_juli_jogja,
                    'Surakarta' => $all_case_juli_solo,
                    'Purwokerto' => $all_case_juli_purwokerto
                ],
                [
                    'Nama' => 'Agustus',
                    'Semua POP' => $all_case_agustus,
                    'Yogyakarta' => $all_case_agustus_jogja,
                    'Surakarta' => $all_case_agustus_solo,
                    'Purwokerto' => $all_case_agustus_purwokerto
                ],
                [
                    'Nama' => 'September',
                    'Semua POP' => $all_case_september,
                    'Yogyakarta' => $all_case_september_jogja,
                    'Surakarta' => $all_case_september_solo,
                    'Purwokerto' => $all_case_september_purwokerto
                ],
                [
                    'Nama' => 'Oktober',
                    'Semua POP' => $all_case_oktober,
                    'Yogyakarta' => $all_case_oktober_jogja,
                    'Surakarta' => $all_case_oktober_solo,
                    'Purwokerto' => $all_case_oktober_purwokerto
                ],
                [
                    'Nama' => 'November',
                    'Semua POP' => $all_case_november,
                    'Yogyakarta' => $all_case_november_jogja,
                    'Surakarta' => $all_case_november_solo,
                    'Purwokerto' => $all_case_november_purwokerto
                ],
                [
                    'Nama' => 'Desember',
                    'Semua POP' => $all_case_desember,
                    'Yogyakarta' => $all_case_desember_jogja,
                    'Surakarta' => $all_case_desember_solo,
                    'Purwokerto' => $all_case_desember_purwokerto],
            ],
        ],200);
    }

    public function statistik_range(Request $request){
        // Object
        $keluhan = new Keluhan;
        $rfo_gangguan = new RFO_Gangguan();

        $dari = $request->get('dari');
        $sampai = $request->get('sampai');
        $range_keluhan_all = $keluhan->whereBetween('created_at', [$dari, $sampai])->count();
        $range_keluhan_jogja = $keluhan->where('pop_id',1)->whereBetween('created_at', [$dari, $sampai])->count();
        $range_keluhan_solo = $keluhan->where('pop_id',2)->whereBetween('created_at', [$dari, $sampai])->count();
        $range_keluhan_purwokerto = $keluhan->where('pop_id',3)->whereBetween('created_at', [$dari, $sampai])->count();
        $range_rfo_gangguan = $rfo_gangguan->whereBetween('created_at', [$dari, $sampai])->count();

        if($range_keluhan_all>0){
            return response()->json([
                'status' => 'success',
                'message' => 'Data statistik berhasil ditemukan',
                'data' => [
                    'all_pop' => $range_keluhan_all,
                    'jogja' => $range_keluhan_jogja,
                    'solo' => $range_keluhan_solo,
                    'purwokerto' => $range_keluhan_purwokerto,
                    'all_rfo_gangguan' => $range_rfo_gangguan,
                    ],
            ], 200);
        }else{
            return response()->json([
                'status'=>"error",
                'mesage' =>"Data statistik tidak ditemukan"
            ],404);
        }
    }

}
