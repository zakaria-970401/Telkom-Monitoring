<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Mail\PengadaanMail;
use App\Mail\PengadaanListMail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\MasterHelpdeskModel;

class TeknisiController extends Controller
{
    public function index()
    {
        $cek_status = DB::table('master_tiket')
                      ->where('kode_area', Auth::user()->kode_area)
                      ->where('status', '!=', 2)
                      ->whereDate('tgl_pengisian', date('Y-m-d'))
                      ->get();

        return view('teknisi.index', compact('cek_status'));
    }

    public function cari_gangguan($no_gangguan)
    {
        $data = DB::table('master_tiket')
                ->where('no_gangguan', $no_gangguan)
                ->first();

        $gangguan = DB::table('master_gangguan')
                    ->where('kode_gangguan', $data->kode_gangguan)
                    ->first();

        return response()->json([
            'status' => 1,
            'data' => [ 
                'data' => $data, 
                'gangguan' => $gangguan, 
              ],
            ]);
    }

    public function cari_penanganan($kode_gangguan)
    {
        $data = DB::table('master_gangguan_solved')
                    ->where('kode_gangguan', $kode_gangguan)
                    ->get();

        return response()->json([
            'status' => 1,
            'data' => $data
            ]);
    }

    public function close_gangguan(Request $request)
    {
        $data = DB::table('master_tiket')
                    ->where('no_gangguan', $request->no_gangguan)
                    ->update([
                        'status' => 0
                    ]);

        $data = DB::table('master_laporan')
                    ->where('no_gangguan', $request->no_gangguan)
                    ->update([
                        'status'        => 0,
                        'jam_pengisian' => date('H:i:s'),
                        'tgl_pengisian' => date('Y-m-d'),
                    ]);
        $gangguan = DB::table('master_tiket')
                    ->join('master_gangguan', 'master_gangguan.kode_gangguan', 'master_tiket.kode_gangguan')
                    ->join('master_gangguan_solved', 'master_gangguan_solved.kode_gangguan', 'master_tiket.kode_gangguan')
                    ->where('no_gangguan', $request->no_gangguan)
                    ->first();

        $message = "\n <b>CLOSE HELPDESK</b>" . ' '. 'AREA' . ' '. $gangguan->kode_area;
        $message .= "\n\n<pre>";
        $message .= "<i>No. Gangguan    : <b>".$gangguan->no_gangguan."</b></i>\n";
        $message .= "Nama Pelanggan  : ".$gangguan->nama_pelanggan."\n";
        $message .= "Alamat          : ".$gangguan->alamat."\n";
        $message .= "Gangguan          : ".$gangguan->deskripsi."\n";
        $message .= "</pre>\n\n\n";
        $message .= "Teknisi         : ".Auth::user()->name." \n";
        $message .= "Penanganan         : ".$gangguan->penanganan." \n";
        $message .= "<i>Waktu          : ".date('d-M-Y H:i') . ' ' . 'WIB' ."</i> \n";

        Telegram::bot('mybot')->sendMessage([
            'chat_id' => '-1001650865838',
            'parse_mode' => 'HTML',
            'text' => $message
        ]);

        Session::flash('info', 'Gangguan Berhasil Di Close..');
        return back();
    }

    public function ubah_status($no_gangguan)
    {
        DB::table('master_tiket')
            ->where('no_gangguan', $no_gangguan)
            ->update([
                'status' => 1
        ]);

        $data = DB::table('master_tiket')
                ->join('master_gangguan', 'master_gangguan.kode_gangguan', '=', 'master_tiket.kode_gangguan')
                ->join('master_gangguan_solved', 'master_gangguan_solved.kode_gangguan', '=', 'master_gangguan.kode_gangguan')
                ->where('master_tiket.no_gangguan', $no_gangguan)
                ->first();

        DB::table('master_laporan')
            ->insert([
                'no_gangguan' => $no_gangguan,
                'nama_teknisi' => Auth::user()->name,
                'nik_teknisi' => Auth::user()->username,
                'kode_gangguan' => $data->kode_gangguan,
                'kode_penanganan' => $data->kode_penanganan,
                'jam_pengisian' => date('H:i:s'),
                'tgl_pengisian' => date('Y-m-d'),
        ]);

        return back();
    }

    public function post_pemakaian(Request $request)
    {
        $kode_barang = $request->kode_barang;
        $qty_pemakaian = $request->qty_pemakaian;
        for($i = 0; $i < count($kode_barang); $i++)
        {
                $id_pengeluaran = DB::table('master_pengeluaran_material')->select('id')
                                ->where('kode_barang', $kode_barang[$i])
                                ->where('status', 3)
                                ->orderBy('id', 'ASC')
                                ->get();

                DB::table('master_transaksi_material')->insert([
                    'nama_teknisi'     => Auth::user()->name,
                    'id_pengeluaran'   => $id_pengeluaran[$i]->id,
                    'no_gangguan'      => $request->no_gangguan,
                    'tindakan'         => $request->tindakan,
                    'qty_pemakaian'    => $qty_pemakaian[$i],
                    'jam_pengisian'    => date('H:i:s'),
                    'tgl_pengisian'    => date('Y-m-d'),
                ]);

            $stok   = DB::table('master_pengeluaran_material')->select('sisa')
                    ->where('kode_barang', $kode_barang[$i])
                    ->where('status', 3)
                    ->orderBy('id', 'ASC')
                    ->get();

                    //update stok//
                    $stok   = DB::table('master_pengeluaran_material')->select('sisa')
                    ->where('kode_barang', $kode_barang[$i])
                    ->where('status', 3)
                    ->update([
                        'sisa' => abs($stok[$i]->sisa - $qty_pemakaian[$i])
                    ]);

            $validasi   = DB::table('master_pengeluaran_material')->select('sisa', 'kode_barang')
                            ->where('kode_barang', $kode_barang[$i])
                            ->orderBy('id', 'ASC')
                            ->where('status', 3)
                            ->get();
        }


        ///update master gangguan///
            DB::table('master_gangguan')
                ->where('no_gangguan',  $request->no_gangguan)
                ->where('status', 1)
                ->update([
                    'status' => 0
                ]);

        return response()->json([
            'status' => 1,
            'data' => $validasi
            ]);
    }

    public function list_wo()
    {
        $data = DB::table('master_laporan')
                ->select(
                    'master_tiket.no_gangguan',
                    'master_laporan.nama_teknisi',
                    'master_laporan.nik_teknisi',
                    'master_tiket.nama_pelanggan',
                    'master_tiket.alamat',
                    'master_gangguan.deskripsi',
                    'master_gangguan_solved.penanganan',
                    'master_tiket.tgl_pengisian as tgl_wo',
                    'master_tiket.jam_pengisian as jam_wo',
                    'master_laporan.jam_pengisian as jam_penanganan',
                    'master_laporan.tgl_pengisian as tgl_penanganan',
                    'master_laporan.status',
                )
                ->join('master_tiket', 'master_tiket.no_gangguan', '=', 'master_laporan.no_gangguan')
                ->join('master_gangguan', 'master_gangguan.kode_gangguan', '=', 'master_laporan.kode_gangguan')
                ->join('master_gangguan_solved', 'master_gangguan_solved.kode_penanganan', '=', 'master_laporan.kode_penanganan')
                ->where('nik_teknisi', Auth::user()->username)
                ->get();

        return view('teknisi.list_wo', compact('data'));
    }
    
     public function detail_tiket($no_gangguan)
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
    
}
