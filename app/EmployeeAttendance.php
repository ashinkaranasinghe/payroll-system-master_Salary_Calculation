<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SalaryGroup;

class EmployeeAttendance extends Model
{
    public $fillable = ['employee_id','ot_hours','ot','month','attendance','allowances','deductions','advances','epf','etf','total','approved','month','year','paye'];
    protected $table = 'employee_salaries';
    public function salaryGroup()
    {
        return $this->belongsTo(SalaryGroup::class);
    }

    /**
     * Get the 
     */
    public function employee()
    {
        return $this->hasOne(Employee::class, 'id','employee_id');

    }
}
