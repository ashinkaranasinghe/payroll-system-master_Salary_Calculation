<?php

namespace App\Http\Requests;

use App\Deduction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreDeductionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('deduction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
