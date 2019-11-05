<?php

namespace App\Http\Controllers\Admin;

use App\Allowance;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAllowanceRequest;
use App\Http\Requests\StoreAllowanceRequest;
use App\Http\Requests\UpdateAllowanceRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowancesController extends Controller
{
    public function index()
    {

        $allowances = Allowance::all();

        return view('admin.allowances.index', compact('allowances'));
    }

    public function create()
    {

        $employees = Employee::all()->pluck('employee_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.allowances.create', compact('employees'));
    }

    public function store(StoreAllowanceRequest $request)
    {
        $allowance = Allowance::create($request->all());

        return redirect()->route('admin.allowances.index');
    }

    public function edit(Allowance $allowance)
    {

        $employees = Employee::all()->pluck('employee_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $allowance->load('employee');

        return view('admin.allowances.edit', compact('employees', 'allowance'));
    }

    public function update(UpdateAllowanceRequest $request, Allowance $allowance)
    {
        $allowance->update($request->all());

        return redirect()->route('admin.allowances.index');
    }

    public function show(Allowance $allowance)
    {

        $allowance->load('employee');

        return view('admin.allowances.show', compact('allowance'));
    }

    public function destroy(Allowance $allowance)
    {

        $allowance->delete();

        return back();
    }

    public function massDestroy(MassDestroyAllowanceRequest $request)
    {
        Allowance::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
