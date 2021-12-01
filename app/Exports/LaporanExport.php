<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $tgl_mulai;
    protected $tgl_selesai;
    protected $varian;
    protected $shift;

       function __construct($tgl_mulai, $tgl_selesai)
    {
           $this->tgl_mulai = $tgl_mulai;
           $this->tgl_selesai = $tgl_selesai;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data   = DB::table('master_tiket')
                ->select(
                    'master_tiket.no_gangguan',
                    'master_tiket.id_pelanggan',
                    'master_tiket.nama_pelanggan',
                    'master_tiket.alamat',
                    'master_tiket.kode_area',
                    'master_tiket.tgl_pengisian as tgl_create',
                    'master_tiket.jam_pengisian as jam_create',
                    'master_gangguan.deskripsi',
                    'master_laporan.nama_teknisi',
                    'master_gangguan_solved.penanganan',
                    'master_laporan.tgl_pengisian as tgl_teknisi',
                    'master_laporan.jam_pengisian as jam_teknisi',
                    'master_laporan.status',
                )
                ->join('master_laporan', 'master_laporan.no_gangguan', '=', 'master_tiket.no_gangguan')
                ->join('master_gangguan', 'master_gangguan.kode_gangguan', '=', 'master_tiket.kode_gangguan')
                ->join('master_gangguan_solved', 'master_gangguan_solved.kode_gangguan', '=', 'master_tiket.kode_gangguan')
                ->whereBetween('master_laporan.tgl_pengisian', [$this->tgl_mulai, $this->tgl_selesai])
                ->groupBy('master_tiket.no_gangguan')
                ->get();

    return collect($data);
    }

    public function headings(): array
    {
        return [
            'No. Gangguan',
            'ID Pelanggan',
            'Nama Pelanggan',
            'Alamat',
            'Area',
            'Tanggal WO',
            'Jam WO',
            'Gangguan',
            'Nama Teknisi',
            'Penanganan',
            'Tanggal Penanganan',
            'Jam Penanganan',
        ];
     }
}
