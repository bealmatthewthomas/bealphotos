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
            'photo.title' => 'required|string|max:30',
            'photo.description' => 'required|string|max:255',
            'photo.file' => 'required|image',
        ];
    }
}
