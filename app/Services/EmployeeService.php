<?php

namespace App\Services;

use App\DTO\EmployeeDTO;
use App\Models\Employee;
use App\Repositories\EmployeeRepository;

class EmployeeService
{
    public function __construct(
        private readonly EmployeeRepository $repository
    ) {}

    public function create(EmployeeDTO $dto): Employee
    {
        return Employee::create([
            'uuid' => $dto->uuid,
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
        ]);
    }


}


