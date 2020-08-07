<?php

use BbsLab\NovaToastUiEditorField\ToastUiEditor;

return [

    'initialEditType' => ToastUiEditor::EDIT_TYPE_WYSIWYG,

    'options' => [
        'minHeight' => '200px',
        'language' => 'en-US',
        'useCommandShortcut' => true,
        'usageStatistics' => false,
        'hideModeSwitch' => false,
        'toolbarItems' => [
            'heading',
            'bold',
            'italic',
            'strike',
            'divider',
            'hr',
            'quote',
            'divider',
            'ul',
            'ol',
            'task',
            'indent',
            'outdent',
            'divider',
            'table',
            'image',
            'link',
            'divider',
            'code',
            'codeblock',
        ],
    ],

    'height' => '300px',

    'previewStyle' => ToastUiEditor::PREVIEW_STYLE_TAB,

    'allowIframe' => false,

    'useCloudinary' => false,

    'cloudinary' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME', ''),
        'api_key' => env('CLOUDINARY_API_KEY', ''),
        'api_secret' => env('CLOUDINARY_API_SECRET', ''),
        'username' => env('CLOUDINARY_USERNAME', ''),
    ],

];
