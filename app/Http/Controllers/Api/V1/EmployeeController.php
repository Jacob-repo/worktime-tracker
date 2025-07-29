<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Services\EmployeeService;
use App\DTO\EmployeeDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;


class EmployeeController extends Controller
{
    public function __construct(
        private readonly EmployeeService $employeeService
    ) {}

    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        $dto = new EmployeeDTO(
            uuid: Str::uuid()->toString(),
            first_name: $request->input('first_name'),
            last_name: $request->input('last_name'),
        );

        $employee = $this->employeeService->create($dto);

        return response()->json([
            'response' => [
                'id' => $dto->uuid, // możesz też użyć $employee->uuid
            ]
        ], 201);
    }

}
