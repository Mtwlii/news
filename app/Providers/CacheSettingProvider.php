<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CacheSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $getSetting =  Setting::firstOr(function () {
            return Setting::create([
                'site_name' => 'News',
                'logo' => '/img/logo.png',
                'favicon' => 'default',
                'city' => 'Mansoura',
                'street' => 'Omar abn abdelazez street',
                'country' => 'Egypt',
                // 'phone' => '01008533066',
                // 'email' => 'news@gmail.com',
                // 'facebook' => 'default',
                // 'instagram' => 'default',
                // 'twitter' => 'default',
                // 'youtube' => 'default',
                'email' => 'metwlii.dev@gmail.com',
                'facebook' => 'https://www.facebook.com/mtwlii',
                'instagram' => 'https://www.instagram.com/mtwlii/',
                'twitter' => 'https://x.com/mtwliii',
                'youtube' => 'https://www.youtube.com/@mtwlii',
                'linkedin' => 'https://www.linkedin.com/in/mtwlii/',
                'phone' => '01008533066',
            ]);
        });
        view()->share([
            'getSetting' => $getSetting
        ]);
    }
}
