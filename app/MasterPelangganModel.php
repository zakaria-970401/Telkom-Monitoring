<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterPelangganModel extends Model
{
    public $timestamps = false;

    protected $table = 'master_pelanggan';

    protected $guarded = [];
}
