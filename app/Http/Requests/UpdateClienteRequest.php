<?php

namespace App\Http\Requests;

use App\Models\Cliente;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClienteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cliente_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'rut' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:clientes,rut,' . request()->route('cliente')->id,
            ],
            'email' => [
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
            'city' => [
                'string',
                'required',
            ],
            'phone' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'screens.*' => [
                'integer',
            ],
            'screens' => [
                'array',
            ],
        ];
    }
}
