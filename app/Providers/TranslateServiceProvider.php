<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class TranslateServiceProvider extends ServiceProvider
{
    protected $dict = [
        'country'  => 'nước',
        'city'     => 'thành phố',
    ];

    public function boot()
    {
        $dic = $this->dict;

        Str::macro('translate', function ($value, $lang = 'vn') use ($dic) {
            return isset($dic[$value]) ? $dic[$value] : $value;
        });
    }
}