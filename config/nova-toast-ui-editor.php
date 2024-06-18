<?php

declare(strict_types=1);

use BbsLab\NovaToastUiEditorField\Enums\ToastUiEditType;
use BbsLab\NovaToastUiEditorField\Enums\ToastUiPreviewStyle;

return [
    'allowIframe' => (bool) env('TOAST_UI_EDITOR_ALLOW_IFRAME', false),

    'height' => env('TOAST_UI_EDITOR_HEIGHT', 'auto'),

    'hideModeSwitch' => (bool)env('TOAST_UI_EDITOR_HIDE_MODE_SWITCH', false),

    'initialEditType' => env('TOAST_UI_EDITOR_INITIAL_EDIT_TYPE', ToastUiEditType::WYSIWYG->value),

    'language' => env('TOAST_UI_EDITOR_LANGUAGE', 'en-US'),

    'minHeight' => env('TOAST_UI_EDITOR_MIN_HEIGHT', '300px'),

    'plugins' => ['chart', 'tableMergedCell', 'uml', 'colorSyntax', 'codeSyntaxHighlight'],

    'previewStyle' => env('TOAST_UI_EDITOR_PREVIEW_STYLE', ToastUiPreviewStyle::TAB->value),

    'toolbarItems' => [
        [
            'heading',
            'bold',
            'italic',
            'strike',
        ],
        [
            'hr',
            'quote',
        ],
        [
            'ul',
            'ol',
            'task',
            'indent',
            'outdent',
        ],
        [
            'table',
            'image',
            'link',
        ],
        [
            'code',
            'codeblock',
        ],
    ],

    'usageStatistics' => (bool)env('TOAST_UI_EDITOR_USAGE_STATISTICS', false),

    'useCloudinary' => (bool) env('TOAST_UI_EDITOR_USE_CLOUDINARY', false),

    'cloudinary' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME', ''),
        'api_key' => env('CLOUDINARY_API_KEY', ''),
        'api_secret' => env('CLOUDINARY_API_SECRET', ''),
        'username' => env('CLOUDINARY_USERNAME', ''),
    ],

    'useCommandShortcut' => (bool)env('TOAST_UI_EDITOR_USE_COMMAND_SHORTCUT', true),
];
