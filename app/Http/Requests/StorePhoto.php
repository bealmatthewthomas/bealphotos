<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoto extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'photo.title' => 'string|max:30|nullable',
            'photo.description' => 'string|max:255|nullable',
            'photo.file' => 'required|image',
            'album.id' => 'int',
        ];
    }
}
