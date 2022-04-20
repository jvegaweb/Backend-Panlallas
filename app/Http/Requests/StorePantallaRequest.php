<?php

namespace App\Http\Requests;

use App\Models\Pantalla;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePantallaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pantalla_create');
    }

    public function rules()
    {
        return [
            'name_screen' => [
                'string',
                'required',
            ],
            'url_tour' => [
                'string',
                'nullable',
            ],
            'brochure' => [
                'string',
                'nullable',
            ],
            'plants' => [
                'string',
                'nullable',
            ],
            'link_video' => [
                'string',
                'nullable',
            ],
            'id_gallery_1s.*' => [
                'integer',
            ],
            'id_gallery_1s' => [
                'array',
            ],
            'id_gallery_2s.*' => [
                'integer',
            ],
            'id_gallery_2s' => [
                'array',
            ],
            'mapa' => [
                'string',
                'nullable',
            ],
        ];
    }
}
