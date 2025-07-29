<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkTimeRequest;
use App\Services\WorkTimeService;
use Illuminate\Http\JsonResponse;

class WorkTimeController extends Controller
{
    public function __construct(
        private readonly WorkTimeService $service
    ) {}

    public function store(StoreWorkTimeRequest $request): JsonResponse
    {
        $this->service->create(
            uuid: $request->input('uuid'),
            startedAt: $request->input('started_at'),
            endedAt: $request->input('ended_at')
        );

        return response()->json([
            'response' => ['Czas pracy został dodany!']
        ]);
    }
}
