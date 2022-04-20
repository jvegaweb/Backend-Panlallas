<?php

namespace App\Http\Requests;

use App\Models\Pantalla;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPantallaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pantalla_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pantallas,id',
        ];
    }
}
