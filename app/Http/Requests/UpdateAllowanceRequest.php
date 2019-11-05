<?php

namespace App\Http\Requests;

use App\Allowance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAllowanceRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('allowance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                'integer',
            ],
            'month'       => [
                'required',
            ],
            'amount'      => [
                'required',
            ],
        ];
    }
}
