<?php

namespace App\Http\Controllers\Admin;

use App\Deduction;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDeductionRequest;
use App\Http\Requests\StoreDeductionRequest;
use App\Http\Requests\UpdateDeductionRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeductionsController extends Controller
{
    public function index()
    {

        $deductions = Deduction::all();

        return view('admin.deductions.index', compact('deductions'));
    }

    public function create()
    {
        abort_if(Gate::denies('deduction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::all()->pluck('employee_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.deductions.create', compact('employees'));
    }

    public function store(StoreDeductionRequest $request)
    {
        $deduction = Deduction::create($request->all());

        return redirect()->route('admin.deductions.index');
    }

    public function edit(Deduction $deduction)
    {
        abort_if(Gate::denies('deduction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employees = Employee::all()->pluck('employee_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $deduction->load('employee');

        return view('admin.deductions.edit', compact('employees', 'deduction'));
    }

    public function update(UpdateDeductionRequest $request, Deduction $deduction)
    {
        $deduction->update($request->all());

        return redirect()->route('admin.deductions.index');
    }

    public function show(Deduction $deduction)
    {
        abort_if(Gate::denies('deduction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deduction->load('employee');

        return view('admin.deductions.show', compact('deduction'));
    }

    public function destroy(Deduction $deduction)
    {
        abort_if(Gate::denies('deduction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deduction->delete();

        return back();
    }

    public function massDestroy(MassDestroyDeductionRequest $request)
    {
        Deduction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
