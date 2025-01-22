<?php

namespace App\Providers;

use App\Models\Profile;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $user = Profile::latest()->first() ?? (object)[
            'id' => 'nol',
            'nama' => 'Belum diatur',
            'nip' => 'Belum diatur',
            'tanda_tangan' => null
        ];

        View::share('user', $user);
    }
}
