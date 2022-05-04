<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StringHelperServiceProvider extends ServiceProvider
{
    public function register()
    {
        require_once app_path() . '/Helpers/StringHelper.php';
    }
}
