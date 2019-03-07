<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlbum extends FormRequest
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
            'album.title' => 'required|string|max:30',
            'album.description' => 'required|string|max:255',
            'category.id' => 'required|int',
        ];
    }
}
