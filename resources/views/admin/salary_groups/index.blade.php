@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Salary groups</h3>
    @can('salary_group_create')
    <p>
        <a href="{{ route('admin.salary_groups.create') }}" class="btn btn-primary">Add new</a>
        
    </p>
    @endcan

    @can('salary_group_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.salary_groups.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.salary_groups.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            Salary Group List
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($salary_groups) > 0 ? 'datatable' : '' }} @can('salary_group_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('salary_group_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>Name</th>
                        <th>Maximum-leave-days</th>
                        <th>Ot-rate</th>
                        <th>salary</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($salary_groups) > 0)
                        @foreach ($salary_groups as $salary_group)
                            <tr data-entry-id="{{ $salary_group->id }}">
                                @can('salary_group_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td>{{ $salary_group->name }}</td>
                                <td>{{ $salary_group->maximum_leave_days }}</td>
                                <td>{{ $salary_group->ot_rate }}</td>
                                <td>{{ $salary_group->salary }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('salary_group_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("Are you sure")."');",
                                        'route' => ['admin.salary_groups.restore', $salary_group->id])) !!}
                                    {!! Form::submit(trans('Restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('salary_group_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Are you sure")."');",
                                        'route' => ['admin.salary_groups.perma_del', $salary_group->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('salary_group_view')
                                    <a href="{{ route('admin.salary_groups.show',[$salary_group->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('salary_group_edit')
                                    <a href="{{ route('admin.salary_groups.edit',[$salary_group->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('salary_group_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Are you sure")."');",
                                        'route' => ['admin.salary_groups.destroy', $salary_group->id])) !!}
                                    {!! Form::submit(trans('Delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">No Salary groups created.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('salary_group_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.salary_groups.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection