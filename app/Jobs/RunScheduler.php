<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Artisan;

class RunScheduler implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public function __construct()
    {
        // Construct if needed
    }

    public function handle()
    {
        Artisan::call('schedule:run'); // Menjalankan Laravel scheduler
    }
}

