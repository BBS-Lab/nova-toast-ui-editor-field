<?php

namespace BbsLab\NovaToastUiEditorField;

use Illuminate\Support\Carbon;
use Laravel\Nova\Fields\Field;

class ToastUiEditor extends Field
{
    const EDIT_TYPE_MARKDOWN = 'markdown';
    const EDIT_TYPE_WYSIWYG = 'wysiwyg';

    const PREVIEW_STYLE_VERTICAL = 'vertical';
    const PREVIEW_STYLE_TAB = 'tab';

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-toast-ui-editor-field';

    /**
     * Indicates if the element should be shown on the index view.
     *
     * @var bool
     */
    public $showOnIndex = false;

    protected $initialEditType;

    protected $options;

    protected $height;

    protected $previewStyle;

    protected $allowIframe;

    protected $useCloudinary;

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->initialEditType = config('nova-toast-ui-editor.initialEditType');
        $this->options = config('nova-toast-ui-editor.options');
        $this->height = config('nova-toast-ui-editor.height');
        $this->previewStyle = config('nova-toast-ui-editor.previewStyle');
        $this->allowIframe = (bool) config('nova-toast-ui-editor.allowIframe');
        $this->useCloudinary = (bool) config('nova-toast-ui-editor.useCloudinary');
    }

    public function initialEditTypeMarkdown()
    {
        $this->initialEditType = static::EDIT_TYPE_MARKDOWN;

        return $this;
    }

    public function initialEditTypeWYSIWYG()
    {
        $this->initialEditType = static::EDIT_TYPE_WYSIWYG;

        return $this;
    }

    public function minHeight(string $minHeight)
    {
        $this->options['minHeight'] = $minHeight;

        return $this;
    }

    public function language(string $language)
    {
        $this->options['language'] = $language;

        return $this;
    }

    public function useCommandShortcut(bool $useCommandShortcut = true)
    {
        $this->options['useCommandShortcut'] = $useCommandShortcut;

        return $this;
    }

    public function hideModeSwitch(bool $hideModeSwitch = true)
    {
        $this->options['hideModeSwitch'] = $hideModeSwitch;

        return $this;
    }

    public function toolbarItems(array $toolbarItems)
    {
        $this->options['toolbarItems'] = $toolbarItems;

        return $this;
    }

    public function height(string $height)
    {
        $this->height = $height;

        return $this;
    }

    public function previewStyleVertical()
    {
        $this->previewStyle = static::PREVIEW_STYLE_VERTICAL;

        return $this;
    }

    public function previewStyleTab()
    {
        $this->previewStyle = static::PREVIEW_STYLE_TAB;

        return $this;
    }

    public function allowIframe(bool $allowIframe = true)
    {
        $this->allowIframe = $allowIframe;

        return $this;
    }

    public function useCloudinary(bool $useCloudinary = true)
    {
        $this->useCloudinary = $useCloudinary;

        return $this;
    }

    /**
     * Return Cloudinary field meta.
     *
     * @return array
     */
    protected function cloudinaryMeta()
    {
        $signature = $this->cloudinarySignature();

        return [
            'string' => $signature['string'],
            'api_key' => config('nova-toast-ui-editor.cloudinary.api_key'),
            'username' => $signature['username'],
            'signature' => $signature['signature'],
            'timestamp' => $signature['timestamp'],
            'cloud_name' => config('nova-toast-ui-editor.cloudinary.cloud_name'),
        ];
    }

    /**
     * Compute Cloudinary signature from environment.
     *
     * @return array
     */
    protected function cloudinarySignature()
    {
        $cloudName = config('nova-toast-ui-editor.cloudinary.cloud_name');
        $username = config('nova-toast-ui-editor.cloudinary.username');
        $apiSecret = config('nova-toast-ui-editor.cloudinary.api_secret');
        $timestamp = Carbon::now()->timestamp;
        $string = 'cloud_name='.$cloudName.'&timestamp='.$timestamp.'&username='.$username.$apiSecret;

        return [
            'string' => $string,
            'username' => $username,
            'timestamp' => $timestamp,
            'signature' => hash('sha256', $string),
        ];
    }

    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'editor' => [
                'initialEditType' => $this->initialEditType,
                'options' => $this->options,
                'height' => $this->height,
                'previewStyle' => $this->previewStyle,
                'allowIframe' => $this->allowIframe === true,
                'useCloudinary' => $this->useCloudinary === true,
                'cloudinary' => $this->useCloudinary === true ? $this->cloudinaryMeta() : null,
            ],
        ]);
    }
}
