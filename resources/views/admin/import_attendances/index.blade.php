@extends('layouts.app')

@section('content')
    <h3 class="page-title">Generate Salary</h3>
    @if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload Validation Error<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif
    <div class="container">
        <form action="/admin/import_attendances/import" enctype="multipart/form-data" method="post">
            @csrf
            <input type="file" name="file" >
            <input class="btn btn-primary" type="submit" value="Calculate" style="margin-top: 10pxe">
        </form>
    </div>
@stop