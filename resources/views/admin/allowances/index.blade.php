@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
<div class="content">

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.allowances.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.allowance.title_singular') }}
                </a>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.allowance.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Allowance">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.allowance.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.allowance.fields.employee') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.allowance.fields.year') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.allowance.fields.month') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.allowance.fields.amount') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allowances as $key => $allowance)
                                    <tr data-entry-id="{{ $allowance->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $allowance->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $allowance->employee->employee_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Allowance::YEAR_SELECT[$allowance->year] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Allowance::MONTH_SELECT[$allowance->month] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $allowance->amount ?? '' }}
                                        </td>
                                        <td>
                                            @can('allowance_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.allowances.show', $allowance->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('allowance_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.allowances.edit', $allowance->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('allowance_delete')
                                                <form action="{{ route('admin.allowances.destroy', $allowance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('allowance_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.allowances.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Allowance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection