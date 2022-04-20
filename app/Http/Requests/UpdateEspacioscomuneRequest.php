<?php

namespace App\Http\Requests;

use App\Models\Espacioscomune;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEspacioscomuneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('espacioscomune_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
