<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Siswa;

class UpdateSiswaKelas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'siswa:update-kelas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perbarui kelas siswa setiap menit dan ubah status menjadi lulus jika mencapai kelas 6';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ambil semua siswa yang masih "masuk"
        $siswas = Siswa::where('status', 'masuk')->get();

        foreach ($siswas as $siswa) {
            // Ubah kelas jika belum mencapai kelas 6
            if ($siswa->kelas < 6) {
                $siswa->kelas = (string)((int)$siswa->kelas + 1);
                $siswa->save();
                $this->info("Siswa {$siswa->nama} kelasnya diperbarui menjadi {$siswa->kelas}");
            } else {
                // Ubah status menjadi lulus jika kelas = 6
                $siswa->status = 'lulus';
                $siswa->save();
                $this->info("Siswa {$siswa->nama} sekarang berstatus {$siswa->status}");
            }
        }

        $this->info('Proses pembaruan selesai.');
    }
}
