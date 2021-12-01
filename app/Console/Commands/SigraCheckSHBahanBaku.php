<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Sigra\SHBahanBaku;

class SigraCheckSHBahanBaku extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sigra:check-sh-bahan-baku';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Untuk cek status expired dari sh bahan baku';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    function expired($expired_date) {
        return (strtotime($expired_date) - strtotime(date('Y-m-d'))) / 86400;
    }

    function sendEmail($emails, $sertifikat)
    {
        foreach($emails as $email)
        {
            Mail::to($email->email_penerima)->send(new SHBahanBaku($sertifikat));
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sertifikat_sh = DB::table('sigra_sertifikat_sh_bahan_baku')
        ->where('archive', 'N')
        ->where('status', 'active')
        ->whereNotNull('tanggal_expired')
        ->get();

        // Get an emails
        $emails = DB::table('sigra_email_penerima')
        ->where('jenis', 'sh_bahan_baku')->get();

        foreach($sertifikat_sh as $sertifikat)
        {
            // dd($sertifikat);
            if($this->expired($sertifikat->tanggal_expired) <= 90 && $this->expired($sertifikat->tanggal_expired) >= 1)
            {
                // Di sini dilakukan send notifikasi
                $this->info('Udah mau expired nih.. '. $sertifikat->tanggal_expired);
                $sertifikat->due_date = $this->expired($sertifikat->tanggal_expired);
                $this->sendEmail($emails, $sertifikat);
            }
        }
    }
}
