<?php

namespace Sorethea\KubeAdmin;

use Illuminate\Support\ServiceProvider;

class KubeAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'kube-admin');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'kube-admin');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('kube-admin.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/kube-admin'),
            ], 'views');

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/kube-admin'),
            ], 'assets');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/kube-admin'),
            ], 'lang');

            // Registering package commands.
            $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'kube-admin');
        //Register the filament plugin resource
        $this->app->register(KubeAdminResourceServiceProvider::class);
        //Register the auth
        $this->app->register(KubeAdminAuthServiceProvider::class);
        // Register the main class to use with the facade
        $this->app->singleton('kube-admin', function () {
            return new KubeAdmin;
        });

    }
}
