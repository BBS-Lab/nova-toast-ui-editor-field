<?php

declare(strict_types=1);

namespace BbsLab\NovaToastUiEditorField;

use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FieldServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('nova-toast-ui-editor')
            ->hasConfigFile(['nova-toast-ui-editor']);
    }

    public function packageBooted()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-toast-ui-editor-field', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-toast-ui-editor-field', __DIR__.'/../dist/css/field.css');
        });
    }
}
