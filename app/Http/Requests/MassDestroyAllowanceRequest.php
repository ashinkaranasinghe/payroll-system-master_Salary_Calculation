<?php

namespace App\Http\Requests;

use App\Allowance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAllowanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('allowance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:allowances,id',
        ];
    }
}
