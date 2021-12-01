<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use Illuminate\Support\Facades\Crypt;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
use App\AuthGroupPermission;
use App\AuthPermission;
use App\AuthGroup;
use App\MasterHelpdeskModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Storage;
use Image;
use Intervention\Image\ImageManager;
use DNS2D;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\FileUpload\InputFile;
use App\Exports\LaporanExport;

class DashboardController extends Controller
{
    public function index()
    {
        $total_hari = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        $day = [];
        for($i = 1; $i <= $total_hari; $i++)
        {
                $hari_ke = $i;
                $hari_ke = (string)$hari_ke;
                $data_harian[] = DB::table('master_laporan')
                                    ->select('id')
                                    ->whereDay('tgl_pengisian', $hari_ke)
                                    ->whereMonth('tgl_pengisian', date('m'))
                                    ->count();
                $day[]  = $i ;
                                    
            }
        $data_harian = $data_harian;
        $day = $day;

        //PIE//
        $all     = DB::table('master_laporan')
                    ->select('master_laporan.kode_gangguan', 'master_gangguan.deskripsi')
                    ->join('master_gangguan', 'master_gangguan.kode_gangguan', '=' , 'master_laporan.kode_gangguan')
                    ->whereMonth('master_laporan.tgl_pengisian', date('m'))
                    ->get()
                    ->groupBy('deskripsi');
        $pie = [];

        foreach($all as $deskripsi => $value)
        {
            $data = DB::table('master_laporan')
                    ->select('master_gangguan.deskripsi', DB::raw('COUNT(*) as count'))
                    ->join('master_gangguan', 'master_gangguan.kode_gangguan', '=' , 'master_laporan.kode_gangguan')->where('master_gangguan.deskripsi', $deskripsi)
                    ->groupBy('deskripsi')
                    ->get();

            foreach($data as $nilai){
                $pie[] = [
                    'name' => $nilai->deskripsi,
                    'y' => $nilai->count,
                ];
            }
        }

        //SPLINE PERBULAN//
        $bulan_ke = DB::table('master_laporan')->select(\DB::raw("COUNT(*) as count"))
                    ->groupBy(\DB::raw("Month(tgl_pengisian)"))
                    ->where('status', '=', 0)
                    ->pluck('count');

        $all   =  DB::table('master_laporan')
                    ->where('status', 0)
                    ->count();

        $bulan = DB::table('master_laporan')->select(\DB::raw("Month(tgl_pengisian) as month"))
                    ->groupBy(\DB::raw("Month(tgl_pengisian)"))
                    ->pluck('month');

        $data_bulan = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($bulan as $index => $value)
        {
                $data_bulanan = $bulan_ke[$index];
                $data_bulan[$value] = $data_bulanan;
        }
        $all = DB::table('master_tiket')->where('status', 0)->count();

        $jatinegara   = DB::table('master_tiket')
                            ->select(DB::raw('master_tiket.tgl_pengisian = master_laporan.tgl_pengisian as hasil'))
                            ->join('master_laporan', 'master_laporan.no_gangguan', '=', 'master_tiket.no_gangguan')
                            ->where('kode_area' , 'JATINEGARA')
                            ->where('master_tiket.status', '=', 0)
                            ->whereYear('master_laporan.tgl_pengisian', date('Y'))
                            ->get();
        $jatinegara = $jatinegara->where('hasil', 1)->count();

        $rawamangun   = DB::table('master_tiket')
                            ->select(DB::raw('master_tiket.tgl_pengisian = master_laporan.tgl_pengisian as hasil'))
                            ->join('master_laporan', 'master_laporan.no_gangguan', '=', 'master_tiket.no_gangguan')
                            ->where('kode_area' , 'RAWAMANGUN')
                            ->where('master_tiket.status', '=', 0)
                            ->whereYear('master_laporan.tgl_pengisian', date('Y'))
                            ->get();

        $rawamangun = $rawamangun->where('hasil', 1)->count();
        
        $pasarebo   = DB::table('master_tiket')
                            ->select(DB::raw('master_tiket.tgl_pengisian = master_laporan.tgl_pengisian as hasil'))
                            ->join('master_laporan', 'master_laporan.no_gangguan', '=', 'master_tiket.no_gangguan')
                            ->where('kode_area' , 'PASARREBO')
                            ->where('master_tiket.status', '=', 0)
                            ->whereYear('master_laporan.tgl_pengisian', date('Y'))
                            ->get();

        $pasarebo = $pasarebo->where('hasil', 1)->count();

        return view('dashboard.index', compact('day', 'data_harian', 'pie', 'data_bulan', 'rawamangun', 'jatinegara', 'pasarebo'));
    }

    public function cari_report($tgl_mulai, $tgl_selesai)
    {
        $data   = DB::table('master_tiket')
                ->select(
                    'master_tiket.id',
                    'master_tiket.tgl_pengisian as tgl_create',
                    'master_tiket.jam_pengisian as jam_create',
                    'master_laporan.tgl_pengisian as tgl_teknisi',
                    'master_laporan.jam_pengisian as jam_teknisi',
                    'master_tiket.nama_pelanggan',
                    'master_tiket.no_gangguan',
                    'master_tiket.id_pelanggan',
                    'master_tiket.alamat',
                    'master_laporan.nama_teknisi',
                    'master_laporan.nik_teknisi',
                    'master_laporan.status',
                    'master_gangguan.deskripsi',
                    'master_gangguan_solved.penanganan',
                    'master_tiket.kode_area',
                    'master_tiket.barcode',
                )
                ->join('master_laporan', 'master_laporan.no_gangguan', '=', 'master_tiket.no_gangguan')
                ->join('master_gangguan', 'master_gangguan.kode_gangguan', '=', 'master_tiket.kode_gangguan')
                ->join('master_gangguan_solved', 'master_gangguan_solved.kode_gangguan', '=', 'master_tiket.kode_gangguan')
                ->whereBetween('master_laporan.tgl_pengisian', [$tgl_mulai, $tgl_selesai])
                ->groupBy('master_laporan.no_gangguan')
                ->get();

        $rawamangun   = DB::table('master_tiket')
                        ->select('master_laporan.id')
                        ->join('master_laporan', 'master_laporan.no_gangguan', '=', 'master_tiket.no_gangguan')
                        ->where('master_tiket.kode_area' , 'RAWAMANGUN')
                        ->where('master_laporan.status', '=', 0)
                        ->whereBetween('master_laporan.tgl_pengisian', [$tgl_mulai, $tgl_selesai])
                        ->count();

        $jatinegara   = DB::table('master_tiket')
                        ->select('master_laporan.id')
                        ->join('master_laporan', 'master_laporan.no_gangguan', '=', 'master_tiket.no_gangguan')
                        ->where('master_tiket.kode_area' , 'JATINEGARA')
                        ->where('master_laporan.status', '=', 0)
                        ->whereBetween('master_laporan.tgl_pengisian', [$tgl_mulai, $tgl_selesai])
                        ->count();

        $pasarebo   = DB::table('master_tiket')
                         ->select('master_laporan.id')
                        ->join('master_laporan', 'master_laporan.no_gangguan', '=', 'master_tiket.no_gangguan')
                        ->where('master_tiket.kode_area' , 'PASARREBO')
                        ->where('master_laporan.status', '=', 0)
                        ->whereBetween('master_laporan.tgl_pengisian', [$tgl_mulai, $tgl_selesai])
                        ->count();

        $all     = DB::table('master_laporan')
                    ->select('master_laporan.kode_gangguan', 'master_gangguan.deskripsi')
                    ->join('master_gangguan', 'master_gangguan.kode_gangguan', '=' , 'master_laporan.kode_gangguan')
                    ->where('master_laporan.status', '=', 0)
                    ->whereBetween('master_laporan.tgl_pengisian', [$tgl_mulai, $tgl_selesai])
                    ->get()
                    ->groupBy('deskripsi');
        $pie = [];

        foreach($all as $deskripsi => $value)
        {
            $pie_data = DB::table('master_laporan')
                    ->select('master_gangguan.deskripsi', DB::raw('COUNT(*) as count'))
                    ->join('master_gangguan', 'master_gangguan.kode_gangguan', '=' , 'master_laporan.kode_gangguan')->where('master_gangguan.deskripsi', $deskripsi)
                    ->whereBetween('master_laporan.tgl_pengisian', [$tgl_mulai, $tgl_selesai])
                    ->groupBy('deskripsi')
                    ->get();

            foreach($pie_data as $nilai){
                $pie_result[] = [
                    'name' => $nilai->deskripsi,
                    'y' => $nilai->count,
                ];
            }
        }

        return response()->json([
            'status' => 1,
            'data'   => [
                'data' => $data,
                'rawamangun' => $rawamangun,
                'pasarebo' => $pasarebo,
                'jatinegara' => $jatinegara,
                'pie_result' => $pie_result,
            ],
        ]);
    }

    public function detail($no_gangguan)
    {
        $data =  MasterHelpdeskModel::where('no_gangguan', $no_gangguan)->first();

       $kode_gangguan = DB::table('master_gangguan')->where('kode_gangguan', $data->kode_gangguan)->first();

       return response()->json([
           'status' => 1,
           'data' => [
               $data, 
               $kode_gangguan
            ],
       ]);
    }

    public function download_excel($tgl_mulai, $tgl_selesai)
    {
        return Excel::download(new LaporanExport($tgl_mulai, $tgl_selesai), 'Report-Gangguan-' . '-'. $tgl_mulai . '--' . $tgl_selesai.'.xls');
    }
}
