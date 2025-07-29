<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\WorkTime;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class WorkTimeService
{
    public function create(string $uuid, string $startedAt, string $endedAt): WorkTime
    {
        $employee = Employee::where('uuid', $uuid)->firstOrFail();

        $start = Carbon::parse($startedAt);
        $end = Carbon::parse($endedAt);
        $workDay = $start->copy()->startOfDay();

        $durationHours = $start->diffInMinutes($end) / 60;

        if ($durationHours > 12) {
            throw ValidationException::withMessages([
                'ended_at' => 'Czas pracy nie może przekraczać 12 godzin.',
            ]);
        }

        $exists = WorkTime::where('employee_id', $employee->id)
            ->whereDate('work_day', $workDay)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'work_day' => 'Czas pracy dla tego dnia został już zarejestrowany.',
            ]);
        }

        return WorkTime::create([
            'employee_id' => $employee->id,
            'started_at' => $start,
            'ended_at' => $end,
            'work_day' => $workDay,
        ]);
    }
}
