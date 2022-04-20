<?php

namespace App\Http\Requests;

use App\Models\Galeriainterior;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGaleriainteriorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('galeriainterior_create');
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
