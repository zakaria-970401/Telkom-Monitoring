<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterHelpdeskModel extends Model
{
    public $timestamps = false;
    protected $table = 'master_tiket';
    protected $guarded = [];
}
