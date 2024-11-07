<?php
namespace App\Providers;

use App\Models\Tugas;
use App\Policies\TugasPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Tugas::class => TugasPolicy::class,
    ];

    public function boot()
    {
        // Otorisasi policy akan otomatis didaftarkan
        //
    }
}

