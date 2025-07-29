<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository
{
    public function create(array $data): Employee
    {
        return Employee::create($data);
    }
}
