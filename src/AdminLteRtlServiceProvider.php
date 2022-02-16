<?php

namespace Taha\AdminLteRtl;

use Encore\Admin\Admin;
use Illuminate\Support\ServiceProvider;

class AdminLteRtlServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(AdminLteRtl $extension)
    {
        if (! AdminLteRtl::boot()) {
            return;
        }

        $vendor_path = 'vendor/laravel-admin-ext/adminlte-rtl/';

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path($vendor_path)],
                'adminlte-rtl'
            );
        }

        Admin::booting(function () use ($vendor_path) {
            array_push(
                Admin::$baseCss,
                $vendor_path.'/adminlte-rtl.css'
            );
        });
    }
}
