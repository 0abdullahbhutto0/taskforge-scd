<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagerEmployeeModel extends Model
{
    protected $table = 'manager_employee';

    protected $fillable = [
        'manager_id',
        'employee_id',
    ];
}
