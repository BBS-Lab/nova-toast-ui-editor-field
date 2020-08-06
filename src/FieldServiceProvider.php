<?php

namespace BbsLab\NovaToastUiEditorField;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/nova-toast-ui-editor.php' => config_path('nova-toast-ui-editor.php'),
        ], 'config');

        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-toast-ui-editor-field', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-toast-ui-editor-field', __DIR__.'/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/nova-toast-ui-editor.php', 'nova-toast-ui-editor');
    }
}
