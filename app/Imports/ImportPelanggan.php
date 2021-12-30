<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\ToModel;
use App\MasterPelangganModel;

class ImportPelanggan implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new MasterPelangganModel([
            'id_pelanggan' => $row['id_pelanggan'],
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'titik_ap' => $row['titik_ap'],
            'titik_ont' => $row['titik_ont'],
            'sn_ap' => $row['sn_ap'],
            'sn_ont' => $row['sn_ont'],
            'lokasi' => $row['kordinat_lokasi'],
            'tgl_pengisian' =>date('Y-m-d'),
            'jam_pengisian' =>date('H:i:s'),
        ]);
    }
}
