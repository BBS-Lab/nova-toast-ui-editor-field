<?php

declare(strict_types=1);

namespace Workbench\App\Nova;

use BbsLab\NovaToastUiEditorField\Enums\ToastUiEditType;
use BbsLab\NovaToastUiEditorField\Enums\ToastUiLanguage;
use BbsLab\NovaToastUiEditorField\ToastUiEditor;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Post extends Resource
{
    public static $model = \Workbench\App\Models\Post::class;

    public static $title = 'title';

    public static $search = [
        'id', 'title',
    ];

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255'),

            Boolean::make('Has Content')
                ->sortable()
                ->rules('required'),

            ToastUiEditor::make('Content')
                ->initialEditType(ToastUiEditType::WYSIWYG)
                ->minHeight('400px')
                ->language(ToastUiLanguage::FRENCH)
                ->sortable()
                ->rules('nullable')
                ->fullWidth()
                ->hide()
                ->dependsOn('has_content', function (ToastUiEditor $field, NovaRequest $request, FormData $formData) {
                    if ($formData->has_content) {
                        $field
                            ->show()
                            ->rules('required');
                    } else {
                        $field->hide();
                    }
                }),

            Boolean::make('Has Content 2')
                ->sortable()
                ->rules('required'),

            ToastUiEditor::make('Content 2')
                ->initialEditType(ToastUiEditType::MARKDOWN)
                ->minHeight('400px')
                ->language(ToastUiLanguage::SPANISH)
                ->sortable()
                ->rules('nullable')
                ->fullWidth()
                ->hide()
                ->dependsOn('has_content_2', function (ToastUiEditor $field, NovaRequest $request, FormData $formData) {
                    if ($formData->has_content_2) {
                        $field
                            ->show()
                            ->rules('required');
                    } else {
                        $field->hide();
                    }
                }),
        ];
    }
}
