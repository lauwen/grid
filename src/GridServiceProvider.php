<?php

namespace Lauwen\Grid;

use Encore\Admin\Admin;
use Illuminate\Support\ServiceProvider;

class GridServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(GridExtension $extension)
    {
        if (! GridExtension::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'grid');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/lauwen/grid')],
                'grid'
            );
        }
        Admin::booting(function () {
            Admin::js('vendor/lauwen/grid/js/lauwen-table.js');
            Admin::js('vendor/lauwen/grid/js/bootstrap-table.min.js');
            Admin::js('vendor/lauwen/grid/js/bootstrap-table-zh-CN.min.js');

            Admin::css('vendor/lauwen/grid/css/lauwen-table.css');
            Admin::css('vendor/lauwen/grid/css/bootstrap-table.min.css');
        });

        $this->app->booted(function () {
            GridExtension::routes(__DIR__.'/../routes/web.php');
        });
    }
}
