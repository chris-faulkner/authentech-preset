<?php

namespace Authentech\AuthentechPreset;

use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class Preset extends LaravelPreset {

    public static function install()
    {
        static::cleanSassDirectory();
        static::updatePackages();
        static::updateMix();
        static::updateScripts();
    }

    public static function cleanSassDirectory()
    {
        rename(resource_path('assets/css'), resource_path('assets/sass'));
        rename(resource_path('assets/sass/app.css'), resource_path('assets/sass/app.scss'));
    }

    public static function updatePackageArray($packages)
    {
        return array_merge(["vue" => "^2.5.7"], Arr::except($packages, [
            'popper.js',
            'lodash',
            'jquery',
            'bootstrap'
        ]));
    }

    public static function updateMix()
    {
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    public static function updateScripts()
    {
        copy(__DIR__.'/stubs/bootstrap.js', resource_path('assets/js/bootstrap.js'));
        copy(__DIR__.'/stubs/app.js', resource_path('assets/js/app.js'));
        File::copyDirectory(__DIR__.'/stubs/components', resource_path('assets/js/components'));
    }

}