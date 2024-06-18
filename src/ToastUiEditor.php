<?php

declare(strict_types=1);

namespace BbsLab\NovaToastUiEditorField;

use BbsLab\NovaToastUiEditorField\Enums\ToastUiEditType;
use BbsLab\NovaToastUiEditorField\Enums\ToastUiLanguage;
use BbsLab\NovaToastUiEditorField\Enums\ToastUiPreviewStyle;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\SupportsDependentFields;

class ToastUiEditor extends Field
{
    use SupportsDependentFields;

    public $component = 'nova-toast-ui-editor-field';

    public $showOnIndex = false;

    protected bool $allowIframe;
    protected string $height;
    protected bool $hideModeSwitch;
    protected ToastUiEditType $initialEditType;
    protected ToastUiLanguage $language;
    protected string $minHeight;
    protected array $plugins;
    protected ToastUiPreviewStyle $previewStyle;
    protected array $toolbarItems;
    protected bool $usageStatistics;
    protected bool $useCloudinary;
    protected bool $useCommandShortcut;

    public function __construct($name, $attribute = null, ?callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->allowIframe = config('nova-toast-ui-editor.allowIframe');
        $this->height = config('nova-toast-ui-editor.height');
        $this->hideModeSwitch = config('nova-toast-ui-editor.hideModeSwitch');
        $this->initialEditType = ToastUiEditType::tryFrom(config('nova-toast-ui-editor.initialEditType')) ?? ToastUiEditType::WYSIWYG;
        $this->language = ToastUiLanguage::tryFrom(config('nova-toast-ui-editor.language')) ?? ToastUiLanguage::ENGLISH;
        $this->minHeight = config('nova-toast-ui-editor.minHeight');
        $this->plugins = config('nova-toast-ui-editor.plugins');
        $this->previewStyle = ToastUiPreviewStyle::tryFrom(config('nova-toast-ui-editor.previewStyle')) ?? ToastUiPreviewStyle::TAB;
        $this->toolbarItems = config('nova-toast-ui-editor.toolbarItems');
        $this->usageStatistics = config('nova-toast-ui-editor.usageStatistics');
        $this->useCloudinary = config('nova-toast-ui-editor.useCloudinary');
        $this->useCommandShortcut = config('nova-toast-ui-editor.useCommandShortcut');
    }

    public function allowIframe(bool $allowIframe = true): static
    {
        $this->allowIframe = $allowIframe;

        return $this;
    }

    public function height(string $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function hideModeSwitch(bool $hideModeSwitch = true): static
    {
        $this->hideModeSwitch = $hideModeSwitch;

        return $this;
    }

    public function initialEditType(ToastUiEditType $editType): static
    {
        $this->initialEditType = $editType;

        return $this;
    }

    public function language(ToastUiLanguage $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function minHeight(string $minHeight): static
    {
        $this->minHeight = $minHeight;

        return $this;
    }

    public function plugins(array $plugins): static
    {
        $this->plugins = $plugins;

        return $this;
    }

    public function previewStyle(ToastUiPreviewStyle $previewStyle): static
    {
        $this->previewStyle = $previewStyle;

        return $this;
    }

    public function toolbarItems(array $toolbarItems): static
    {
        $this->toolbarItems = $toolbarItems;

        return $this;
    }

    public function usageStatistics(bool $usageStatistics = true): static
    {
        $this->usageStatistics = $usageStatistics;

        return $this;
    }

    public function useCloudinary(bool $useCloudinary = true): static
    {
        $this->useCloudinary = $useCloudinary;

        return $this;
    }

    public function useCommandShortcut(bool $useCommandShortcut = true): static
    {
        $this->useCommandShortcut = $useCommandShortcut;

        return $this;
    }

    protected function cloudinaryMeta(): array
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

    protected function cloudinarySignature(): array
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

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'editor' => [
                'allowIframe' => $this->allowIframe,
                'options' => [
                    'height' => $this->height,
                    'minHeight' => $this->minHeight,
                    'previewStyle' => $this->previewStyle->value,
                    'initialEditType' => $this->initialEditType->value,
                    'language' => $this->language->value,
                    'useCommandShortcut' => $this->useCommandShortcut,
                    'usageStatistics' => $this->usageStatistics,
                    'toolbarItems' => $this->toolbarItems,
                    'hideModeSwitch' => $this->hideModeSwitch,
                    'plugins' => $this->plugins,
                ],
                'useCloudinary' => $this->useCloudinary,
                'cloudinary' => $this->useCloudinary ? $this->cloudinaryMeta() : null,

            ],
        ]);
    }
}
