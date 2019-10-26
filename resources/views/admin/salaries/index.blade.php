@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Monthly Salaries</h3>

    <div class="container  col-xs-4">


    <div class="panel panel-default">
    <div class="panel-heading">
            Generate Salaries
    </div>

    <div class="panel-body">
    <form action="{{route('admin.salaries.getSalaries)}}" method="post">
    <div class="form-group col-xs-12">
            <label for="exampleFormControlSelect1">Year</label>
            <select class="form-control" id="exampleFormControlSelect1">
                <option>1995</option>
                <option>1996</option>
                <option>1997</option>
                <option>1998</option>
                <option>1999</option>
                <option>2000</option>
                <option>2001</option>
                <option>2002</option>
                <option>2003</option>
                <option>2004</option>
                <option>2005</option>
                <option>2006</option>
                <option>2007</option>
                <option>2008</option>
                <option>2009</option>
                <option>2010</option>
                <option>2011</option>
                <option>2012</option>
                <option>2013</option>
                <option>2014</option>
                <option>2015</option>
                <option>2016</option>
                <option>2017</option>
                <option>2018</option>
                <option>2019</option>
                <option>2020</option>
                <option>2021</option>
                <option>2022</option>
                <option>2023</option>
                <option>2024</option>
                <option>2025</option>
                <option>2026</option>
                <option>2027</option>
                <option>2028</option>
                <option>2029</option>
                <option>2030</option>
            </select>
        </div>
    <div class="form-group col-xs-12">
    <label for="exampleFormControlSelect2">Month</label>
    <select class="form-control" id="exampleFormControlSelect2">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      <option>10</option>
      <option>11</option>
      <option>12</option>
    </select>
  </div>
  <div class="form-group col-xs-12">
    <input class="btn btn-primary" type="submit" value="Submit" style="margin-top: 10pxe">
  </div>
</form>
    </div>

</div>
</div>
    <div class="panel panel-default col-xs-8">
        <div class="panel-heading">
            Salaries List
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($salaries) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Attended Dates</th>
                        <th>OT Hours</th>
                        <th>Salary</th>
                        <th>Approved</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    @if (count($salaries) > 0)
                        @foreach ($salaries as $salary)
                            <tr data-entry-id="{{ $salary->id }}">


                                <td field-key='first_name'>{{ $salary->employee->first_name }}</td>
                                <td field-key='last_name'>{{ $salary->attendance }}</td>
                                <td field-key='birthday'>{{ $salary->ot_hours }}</td>
                                <td field-key='contact__no'>{{ $salary->total }}</td>
                                <td field-key='employee_no'>{{ $salary->approved }}</td>

                                <td>
                                    @if(!$salary->approved)
                                    <a href="{{ route('admin.salaries.approve',[$salary->id]) }}" class="btn btn-xs btn-primary">Approve</a>

                                    <a href="{{ route('admin.salaries.edit',[$salary->id]) }}" class="btn btn-xs btn-primary">Edit</a>

                                    @else
                                    <a href="{{ route('admin.salaries.approve',[$salary->id]) }}" class="btn btn-xs btn-primary disabled">Approve</a>

                                    <a href="{{ route('admin.salaries.edit',[$salary->id]) }}" class="btn btn-xs btn-primary disabled">Edit</a>

                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        @can('employee_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.employees.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection
