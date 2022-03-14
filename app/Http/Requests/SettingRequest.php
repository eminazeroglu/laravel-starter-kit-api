<?php

namespace App\Http\Requests;

use App\Rules\ImageBase64Rule;

class SettingRequest extends ApiRequest
{
    public function __construct()
    {
        $this->permission = 'setting';
    }

    public function generalRule(): array
    {
        return [
            'value.language' => 'required|exists:languages,code'
        ];
    }

    public function logoRule(): array
    {
        return [
            'value.logo'      => ['nullable', new ImageBase64Rule],
            'value.footer'    => ['nullable', new ImageBase64Rule],
            'value.mobile'    => ['nullable', new ImageBase64Rule],
            'value.favicon'   => ['nullable', new ImageBase64Rule],
            'value.wallpaper' => ['nullable', new ImageBase64Rule],
        ];
    }

    public function rules(): array
    {
        $method = request()->key . 'Rule';
        return array_merge([
            'key' => 'required'
        ], method_exists($this, $method) ? $this->$method() : []);
    }

    public function messages(): array
    {
        return [
            'value.language.required'     => helper()->translate('validator.Required'),
            'value.logo.base64image'      => helper()->translate('validator.Image'),
            'value.footer.base64image'    => helper()->translate('validator.Image'),
            'value.mobile.base64image'    => helper()->translate('validator.Image'),
            'value.favicon.base64image'   => helper()->translate('validator.Image'),
            'value.wallpaper.base64image' => helper()->translate('validator.Image'),
        ];
    }
}
