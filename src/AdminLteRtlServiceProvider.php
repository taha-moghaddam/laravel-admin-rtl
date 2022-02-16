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
                $vendor_path.'MaterialAdminLTE/dist/css/bootstrap-material-design.min.css',
                $vendor_path.'MaterialAdminLTE/dist/css/ripples.min.css',
                $vendor_path.'MaterialAdminLTE/dist/css/MaterialAdminLTE.min.css',
                $vendor_path.'MaterialAdminLTE/dist/css/skins/'.$skin.'.min.css',
                $vendor_path.'MaterialAdminLTE/dist/css/custom.css'
            );
            array_push(
                Admin::$baseJs,
                $vendor_path.'MaterialAdminLTE/dist/js/material.min.js',
                $vendor_path.'MaterialAdminLTE/dist/js/ripples.min.js'
            );

            Admin::script('$.material.init()');
        });
    }
}
