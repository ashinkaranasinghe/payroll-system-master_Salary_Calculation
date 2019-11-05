@extends('layouts.app')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('cruds.deduction.title') }}
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.deduction.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $deduction->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.deduction.fields.employee') }}
                                    </th>
                                    <td>
                                        {{ $deduction->employee->employee_no ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.deduction.fields.year') }}
                                    </th>
                                    <td>
                                        {{ App\Deduction::YEAR_SELECT[$deduction->year] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.deduction.fields.month') }}
                                    </th>
                                    <td>
                                        {{ App\Deduction::MONTH_SELECT[$deduction->month] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.deduction.fields.amount') }}
                                    </th>
                                    <td>
                                        ${{ $deduction->amount }}
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