<?php

namespace App\Http\Requests;

use App\Deduction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateDeductionRequest extends FormRequest
{
    public function authorize()
    {

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
