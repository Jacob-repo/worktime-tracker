<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkTimeSummaryRequest;
use App\Services\WorkTimeSummaryService;
use Illuminate\Http\JsonResponse;

class WorkTimeSummaryController extends Controller
{
    public function __construct(private readonly WorkTimeSummaryService $service) {}

    public function day(WorkTimeSummaryRequest $request): JsonResponse
    {
        $data = $this->service->getDailySummary($request->input('uuid'), $request->input('date'));

        return response()->json(['response' => $data]);
    }

    public function month(WorkTimeSummaryRequest $request): JsonResponse
    {
        $data = $this->service->getMonthlySummary($request->input('uuid'), $request->input('date'));

        return response()->json(['response' => $data]);
    }
}
