@extends('layouts.app')

@section('content')
<div class="form-group col-xs-12">
    <h3 class="page-title" style="margin-top: 10px ,algin: center, text:bold" >Generate Salary</h3>
    
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
        <form action="/admin/import_attendances/import" enctype="multipart/form-data"  method="post">
            @csrf
            <input type="file" name="file"  style="margin-top: 10px" >
            <input class="btn btn-primary" type ="submit" value = "Genarate Salary" style="margin-top: 10px">
        </form>
    </div>
    
@stop
</div>