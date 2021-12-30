<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;
use Illuminate\Support\Facades\Auth;
use Session;
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
use App\Imports\ImportPelanggan;

class HelpdeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('master_gangguan')->get();
        $pelanggan = DB::table('master_pelanggan')->get();

        $tiket = DB::table('master_tiket')->select('id')->orderBy('id' ,'DESC')->first();
        if($tiket != NULL)
        {
            $no_gangguan = $tiket->id;
        }
        else
        {
            $no_gangguan = 1;

        }

        return view('helpdesk.index', compact('data', 'no_gangguan', 'pelanggan'));
    }

    public function master_helpdesk()
    {
        $data = DB::table('master_tiket')->get();

        return view('helpdesk.master', compact('data'));
    }

    public function master_pelanggan()
    {
        $data = DB::table('master_pelanggan')->get();

        return view('helpdesk.master_pelanggan', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Storage::disk('public')->put($request->no_gangguan.'.png',base64_decode(DNS2D::getBarcodePNG($request->no_gangguan, "QRCODE")));
        
        MasterHelpdeskModel::create([
            'no_gangguan' => $request->no_gangguan,
            'id_pelanggan' => $request->id_pelanggan,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'titik_ont' => $request->titik_ont,
            'titik_ap' => $request->titik_ap,
            'sn_ap' => $request->sn_ap,
            'sn_ont' => $request->sn_ont,
            'kode_gangguan' => $request->kode_gangguan,
            'kode_area' => $request->kode_area,
            'kordinat_pelanggan' => $request->kordinat_pelanggan,
            'tgl_pengisian' => date('Y-m-d'),
            'jam_pengisian' => date('H:i:s'),
            'barcode' => $request->no_gangguan.'.png',
        ]);

        $message = "\n <b>WO HELPDESK</b>" . ' '. 'UNTUK' . ' '. $request->kode_area;
        $message .= "\n\n\n<pre>";
        $message .= "Nama Pelanggan : ".$request->nama_pelanggan." \n";
        $message .= "Alamat         : ".$request->alamat." \n";
        $message .= "Titik ONT      : ".$request->titik_ont." \n";
        $message .= "Titik AP       : ".$request->titik_ap." \n";
        $message .= "MAPS           : ".$request->kordinat_pelanggan." \n";
        $message .= "Team           : ".$request->kode_area." \n";
        $message .= "</pre>\n\n\n";
        $message .= "<i>No. Gangguan    : ".$request->no_gangguan."</i>\n";
        $message .= "<i>Waktu           : ".date('d-M-Y H:i') . ' ' . 'WIB' ."</i> \n";

        Telegram::bot('mybot')->sendMessage([
            'chat_id' => '-1001650865838',
            'parse_mode' => 'HTML',
            'text' => $message
        ]);

        $foto = DB::table('master_tiket')->where('no_gangguan', $request->no_gangguan)->first();

            Telegram::bot('mybot')->sendPhoto([
                    'chat_id' => '-1001650865838',
                    'parse_mode' => 'HTML',
                    'photo' => InputFile::create(storage_path('app/public/'.$foto->barcode), $foto->barcode)
                ]);

        Session::flash('info', 'Tiket Berhasil Di Buat..');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function update_pelanggan(Request $request)
    {
        // dd($request->all());
        DB::table('master_pelanggan')->where('id', $request->id)
        ->update([
            'id_pelanggan' => $request->id_pelanggan,
            'nama' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'titik_ap' => $request->titik_ap,
            'titik_ont' => $request->titik_ont,
            'sn_ap' => $request->sn_ap,
            'sn_ont' => $request->sn_ont,
            'lokasi' => $request->kordinat_pelanggan,
        ]);
        Session::flash('info', 'Data Berhasil Di Update..');
        return back();
    }

    public function import_pelanggan(Request $request)
    {
        $excel = $request->file('file');
        $data = Excel::import(new ImportPelanggan, $excel);
        Session::flash('info', 'Data Berhasil Di Import..');
        return back();
    }
    
    public function hapus_pelanggan($id)
    {
        DB::table('master_pelanggan')->where('id', $id)->delete();
        Session::flash('info', 'Data Berhasil Di Hapus..');
        return back();
    }

    public function detail_pelanggan($id)
    {
       $data =  DB::table('master_pelanggan')->where('id', $id)->first();

       return response()->json([
           'status' => 1,
           'data' => $data
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update_tiket(Request $request)
    {
        // dd($request->all());
        $no_gangguan = $request->no_gangguan;
        $data = MasterHelpdeskModel::where('no_gangguan', $no_gangguan)->first();
        $data->fill($request->all())->save();

        $message = "\n <b>PERUBAHAN DATA WO HELPDESK</b>" . ' '. 'UNTUK' . ' '. $request->kode_area;
        $message .= "\n\n\n<pre>";
        $message .= "Nama Pelanggan : ".$request->nama_pelanggan." \n";
        $message .= "Alamat         : ".$request->alamat." \n";
        $message .= "Titik ONT      : ".$request->titik_ont." \n";
        $message .= "Titik AP       : ".$request->titik_ap." \n";
        $message .= "MAPS           : ".$request->kordinat_pelanggan." \n";
        $message .= "Team           : ".$request->kode_area." \n";
        $message .= "</pre>\n\n\n";
        $message .= "<i>Waktu       : ".date('d-M-Y H:i') . ' ' . 'WIB' ."</i> \n";

         Telegram::bot('mybot')->sendMessage([
            'chat_id' => '-1001650865838',
            'parse_mode' => 'HTML',
            'text' => $message
        ]);

        $foto = MasterHelpdeskModel::where('no_gangguan', $no_gangguan)->first();

            Telegram::bot('mybot')->sendPhoto([
                    'chat_id' => '-1001650865838',
                    'parse_mode' => 'HTML',
                    'photo' => InputFile::create(storage_path('app/public/'.$foto->barcode), $foto->barcode)
                ]);

        Session::flash('info', 'Tiket Berhasil Di Update..');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapus_tiket($no_gangguan)
    {
        MasterHelpdeskModel::where('no_gangguan', $no_gangguan)->delete();

        Session::flash('info', 'Tiket Berhasil Di Hapus..');
        return back();
    }
}
