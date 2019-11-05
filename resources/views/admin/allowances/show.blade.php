@extends('layouts.app')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.allowance.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.allowance.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $allowance->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.allowance.fields.employee') }}
                                    </th>
                                    <td>
                                        {{ $allowance->employee->employee_no ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.allowance.fields.year') }}
                                    </th>
                                    <td>
                                        {{ App\Allowance::YEAR_SELECT[$allowance->year] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.allowance.fields.month') }}
                                    </th>
                                    <td>
                                        {{ App\Allowance::MONTH_SELECT[$allowance->month] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.allowance.fields.amount') }}
                                    </th>
                                    <td>
                                        ${{ $allowance->amount }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection