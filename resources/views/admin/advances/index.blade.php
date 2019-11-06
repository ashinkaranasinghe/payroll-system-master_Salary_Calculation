@extends('layouts.app')
@section('content')
<div class="content">

        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route("admin.advances.create") }}">
                    New Advance
                </a>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.advance.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Advance">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    
                                    <th>
                                        Employee Id
                                    </th>
                                    <th>
                                        Year
                                    </th>
                                    <th>
                                        Month
                                    </th>
                                    <th>
                                      Amount
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($advances as $key => $advance)
                                    <tr data-entry-id="{{ $advance->id }}">
                                        <td>

                                        </td>
                                        
                                        <td>
                                            {{ $advance->employee->employee_no ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Advance::YEAR_SELECT[$advance->year] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Advance::MONTH_SELECT[$advance->month] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $advance->amount ?? '' }}
                                        </td>
                                        <td>

                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.advances.show', $advance->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>

                                                <a class="btn btn-xs btn-info" href="{{ route('admin.advances.edit', $advance->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>


      
                                                <form action="{{ route('admin.advances.destroy', $advance->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('admin.advances.massDestroy') }}",
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
  $('.datatable-Advance:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection