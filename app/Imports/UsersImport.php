<?php

namespace App\Imports;
use App\Employee;
use App\EmployeeFund;
use App\EmployeeAttendance;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $employee = Employee::find($row[0]);
        $epf = EmployeeFund::where('fund_name', 'epf')->first();
        $etf = EmployeeFund::where('fund_name', 'etf')->first();
        
        $epfPercentage = ($epf->employee_percentage)*0.01*($employee->salary_group->salary);
        $etfPercentage = ($etf->employee_percentage)*0.01*($employee->salary_group->salary);
        
        $ot =  ($employee->salary_group->ot_rate) * $row[2];
        $total = ($employee->salary_group->salary) - $epfPercentage - $etfPercentage + $ot;
        return new EmployeeAttendance([
            'employee_id'     => $row[0],
            'attendance' => $row[1],
            'ot'        => $ot,
            'ot_hours' => $row[2],
            'month'    => $row[3], 
            'year'  => $row[4],
            'approved' => false,
            'allowances' => 0,
            'deductions' => 0,
            'epf' => $epfPercentage,
            'etf' => $etfPercentage,
            'total' => $total
         ]);
    }
}
