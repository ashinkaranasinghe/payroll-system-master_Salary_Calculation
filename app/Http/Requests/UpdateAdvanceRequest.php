<?php

namespace App\Http\Requests;

use App\Advance;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAdvanceRequest extends FormRequest
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
