<?php

namespace App\Imports;
use App\Employee;
use App\EmployeeFund;
use App\EmployeeAttendance;
use App\Allowance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $employee = Employee::find($row['employee_num']);
        $epf = EmployeeFund::where('fund_name', 'epf')->first();
        $etf = EmployeeFund::where('fund_name', 'etf')->first();
        
        $epfPercentage = ($epf->employee_percentage)*0.01*($employee->salary_group->salary);
        $etfPercentage = ($etf->employee_percentage)*0.01*($employee->salary_group->salary);
        
        $ot =  ($employee->salary_group->ot_rate) * $row['ot_hours'];

        $paye = 0;
        if($employee->salary_group->salary > 100000){
            $paye = ($employee->salary_group->salary) * 0.08;
        }

        $total = ($employee->salary_group->salary) - $epfPercentage - $etfPercentage + $ot - $paye;
        
        $allowances = Allowance::where([['employee_id', '=',$row['employee_num']],['year', '=',$row['year']],['month', '=',$row['month']]])->sum('amount');
        
        return new EmployeeAttendance([
            'employee_id'     => $row['employee_num'],
            'attendance' => $row['attendance'],
            'ot'        => $ot,
            'ot_hours' => $row['ot_hours'],
            'month'    => $row['month'], 
            'year'  => $row['year'],
            'approved' => false,
            'paye' => $paye,
            'allowances' => $allowances,
            'deductions' => 0,
            'epf' => $epfPercentage,
            'etf' => $etfPercentage,
            'total' => $total
         ]);
    }
}
