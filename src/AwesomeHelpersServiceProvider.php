<?php

namespace Calebporzio\AwesomeHelpers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class AwesomeHelpersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Str::mixin(new StrMacros);

        foreach (scandir(__DIR__.DIRECTORY_SEPARATOR.'helpers') as $helperFile) {
            $path = sprintf(
                '%s%s%s%s%s',
                __DIR__,
                DIRECTORY_SEPARATOR,
                'helpers',
                DIRECTORY_SEPARATOR,
                $helperFile
            );

            if (! is_file($path)) {
                continue;
            }

            $function = str_before($helperFile, '.php');

            if (function_exists($function)) {
                continue;
            }

            require_once $path;
        }
    }
}
