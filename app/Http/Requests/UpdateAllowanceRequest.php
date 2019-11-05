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
