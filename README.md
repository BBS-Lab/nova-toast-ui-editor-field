# Laravel Nova Toast UI Editor field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bbs-lab/nova-toast-ui-editor-field.svg?style=flat-square)](https://packagist.org/packages/bbs-lab/nova-toast-ui-editor-field)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![StyleCI](https://styleci.io/repos/285347026/shield)](https://styleci.io/repos/285347026)
[![Quality Score](https://img.shields.io/scrutinizer/g/bbs-lab/nova-toast-ui-editor-field.svg?style=flat-square)](https://scrutinizer-ci.com/g/bbs-lab/nova-toast-ui-editor-field)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/bbs-lab/nova-toast-ui-editor-field/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/bbs-lab/nova-toast-ui-editor-field/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/bbs-lab/nova-toast-ui-editor-field.svg?style=flat-square)](https://packagist.org/packages/bbs-lab/nova-toast-ui-editor-field)

A [Toast UI Editor](https://ui.toast.com/tui-editor) field for Laravel Nova.

![toast ui editor field screenshot](https://bbs-lab.github.io/nova-toast-ui-editor-field/nova-toast-ui-editor-field.png)

## Contents

- [Installation](#installation)
- [Usage](#usage)
- [Advanced usage](#advanced-usage)
    - [Toast UI Editor configuration](#toast-ui-editor-configuration)
        - [initialEditType](#initialedittype)
        - [options](#options)
        - [height](#height)
        - [previewStyle](#previewstyle)
    - [Allow iframe in markdown/html](#allow-iframe-in-markdownhtml)
    - [Use Cloudinary as image picker](#use-cloudinary-as-image-picker)
- [Changelog](#changelog)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

You can install the package via composer:

``` bash
composer require bbs-lab/nova-toast-ui-editor-field
```

The package will automatically register itself.

You can publish the config-file with:

```bash
php artisan vendor:publish --provider="BbsLab\NovaToastUiEditorField\FieldServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
<?php

return [

    'cloudinary' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME', ''),
        'api_key' => env('CLOUDINARY_API_KEY', ''),
        'api_secret' => env('CLOUDINARY_API_SECRET', ''),
        'username' => env('CLOUDINARY_USERNAME', ''),
    ],

];
```


## Usage

You can use the `BBSLab\NovaToastUiEditorField\ToastUiEditor` field in your Nova resource:

```php
<?php

namespace App\Nova;

use BBSLab\NovaToastUiEditorField\ToastUiEditor;
use Illuminate\Http\Request;

class BlogPost extends Resource
{
    // ...
    
    public function fields(Request $request)
    {
        return [
            // ...

            ToastUiEditor::make('Content'),

            // ...
        ];
    }
    
}
```
## Advanced usage

### Toast UI Editor configuration

You may configure the underlying Toast UI Editor instance with the following field's methods.
Checkout [Toast UI - Vue Editor](https://github.com/nhn/tui.editor/tree/master/apps/vue-editor#props) documentation.

#### initialEditType

`initialEditTypeMarkdown()`

`initialEditTypeWYSIWYG()`

#### options

`minHeight(string $minHeight)`

`language(string $language)`

`useCommandShortcut(bool $useCommandShortcut = true)`

`hideModeSwitch(bool $hideModeSwitch = true)`

`toolbarItems(array $toolbarItems)`

#### height

`height(string $height)`

#### previewStyle

`previewStyleVertical()`

`previewStyleTab()`

### Allow iframe in markdown/html

`allowIframe(bool $allowIframe = true)`

### Use Cloudinary as image picker

`useCloudinary(bool $useCloudinary = true)`

> You must configure your Cloudinary credentials as described in nova-toast-ui-editor-field config file.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on recent changes.

## Security

If you discover any security related issues, please email paris@big-boss-studio.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Mikaël Popowicz](https://github.com/mikaelpopowicz)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
