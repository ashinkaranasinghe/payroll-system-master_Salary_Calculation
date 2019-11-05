<?php

namespace App\Http\Controllers\Admin;

use App\Advance;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAdvanceRequest;
use App\Http\Requests\StoreAdvanceRequest;
use App\Http\Requests\UpdateAdvanceRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdvancesController extends Controller
{
    public function index()
    {

        $advances = Advance::all();

        return view('admin.advances.index', compact('advances'));
    }

    public function create()
    {

        $employees = Employee::all()->pluck('employee_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.advances.create', compact('employees'));
    }

    public function store(StoreAdvanceRequest $request)
    {
        $advance = Advance::create($request->all());

        return redirect()->route('admin.advances.index');
    }

    public function edit(Advance $advance)
    {

        $employees = Employee::all()->pluck('employee_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $advance->load('employee');

        return view('admin.advances.edit', compact('employees', 'advance'));
    }

    public function update(UpdateAdvanceRequest $request, Advance $advance)
    {
        $advance->update($request->all());

        return redirect()->route('admin.advances.index');
    }

    public function show(Advance $advance)
    {

        $advance->load('employee');

        return view('admin.advances.show', compact('advance'));
    }

    public function destroy(Advance $advance)
    {

        $advance->delete();

        return back();
    }

    public function massDestroy(MassDestroyAdvanceRequest $request)
    {
        Advance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
