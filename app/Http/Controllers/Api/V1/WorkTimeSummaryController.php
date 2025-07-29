<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\WorkTimeSummaryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WorkTimeSummaryController extends Controller
{
    public function __construct(
        private readonly WorkTimeSummaryService $summaryService
    ) {}

    public function day(Request $request): JsonResponse
    {
        $request->validate([
            'uuid' => ['required', 'uuid', 'exists:employees,uuid'],
            'date' => ['required', 'date'],
        ]);

        $summary = $this->summaryService->getDailySummary(
            uuid: $request->input('uuid'),
            date: $request->input('date')
        );

        return response()->json(['response' => $summary]);
    }

    public function month(Request $request): JsonResponse
    {
        $request->validate([
            'uuid' => ['required', 'uuid', 'exists:employees,uuid'],
            'date' => ['required', 'regex:/^\d{4}-\d{2}$/'], // format: YYYY-MM
        ]);

        $summary = $this->summaryService->getMonthlySummary(
            uuid: $request->input('uuid'),
            date: $request->input('date')
        );

        return response()->json(['response' => $summary]);
    }
}
