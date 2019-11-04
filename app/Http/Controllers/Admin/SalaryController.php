<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\EmployeeAttendance;
use App\EmployeeFund;
use App\Http\Requests\Admin\UpdateEmployeesRequest;
use App\Http\Requests\Admin\UpdateSalariesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    /**
     * Display a listing of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $salaries = EmployeeAttendance::all();
        return view('admin.salaries.index', compact('salaries'));
    }

    /**
     * Display Employee.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {

        $employeeAttendance = EmployeeAttendance::findOrFail($id);
        $approved="approved";
        \Log::info($employeeAttendance->$approved);
        $employeeAttendance->$approved = '1';
        \Log::info($employeeAttendance->$approved);
        $employeeAttendance->save();
        $salaries = EmployeeAttendance::all();
        return view('admin.salaries.index', compact('salaries'));
    }

    public function edit($id){
        $employeeAttendance = EmployeeAttendance::findOrFail($id);
        return view('admin.salaries.edit', compact('employeeAttendance'));
    }

    /**
     * Update Employee in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalariesRequest $request, $id)
    {

        $employeeSalary = EmployeeAttendance::findOrFail($id);
        $data = $request->all();


        $employee = $employeeSalary->employee;

        $epf = EmployeeFund::where('fund_name', 'epf')->first();
        $etf = EmployeeFund::where('fund_name', 'etf')->first();

        $epfPercentage = ($epf->employee_percentage)*0.01*($employee->salary_group->salary);
        $etfPercentage = ($etf->employee_percentage)*0.01*($employee->salary_group->salary);
        \Log::info($data['ot_hours']);
        \Log::info($employee->salary_group->ot_rate);
        $ot =  ($employee->salary_group->ot_rate) *$data['ot_hours'];
        $total = ($employee->salary_group->salary) - $epfPercentage - $etfPercentage + $ot;

        $data['ot'] = $ot;
        $data['total'] = $total;

        $employeeSalary->update($data);
        return redirect()->route('admin.salaries.index');
    }

    public function getSalaries(Request $request)
    {
        $year = $request['year'];
        $month = $request['month'];
        $salaries = EmployeeAttendance::where('month', '=', $month)->where('year', '=', $year)->get();
        return view('admin.salaries.index', compact('salaries'));
    }


}
