@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
<div class="content">
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route("admin.deductions.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.deduction.title_singular') }}
                </a>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.deduction.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Deduction">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.deduction.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.deduction.fields.employee') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.deduction.fields.year') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.deduction.fields.month') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.deduction.fields.amount') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deductions as $key => $deduction)
                                    <tr data-entry-id="{{ $deduction->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $deduction->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $deduction->employee->employee_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Deduction::YEAR_SELECT[$deduction->year] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Deduction::MONTH_SELECT[$deduction->month] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $deduction->amount ?? '' }}
                                        </td>
                                        <td>
 
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.deductions.show', $deduction->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>


                     
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.deductions.edit', $deduction->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
    

                        
                                                <form action="{{ route('admin.deductions.destroy', $deduction->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                         

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

  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.deductions.massDestroy') }}",
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Deduction:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection