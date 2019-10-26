<?php
namespace App\Http\Controllers\Admin;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Excel;

class ImportAttendancesController extends Controller
{
    public function index()
    {
        if (! Gate::allows('import_attendance_access')) {
            return abort(401);
        }
        return view('admin.import_attendances.index');
    }

    public function import() 
    {
        Excel::import(new UsersImport, request()->file('file'));
        
        return redirect('/')->with('success', 'All good!');
    }
}
