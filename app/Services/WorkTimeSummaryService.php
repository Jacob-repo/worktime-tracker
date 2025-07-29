<?php

namespace App\Services;

use App\Models\Employee;
use Carbon\Carbon;

class WorkTimeSummaryService
{
    private int $normalHours;
    private int $rate;
    private int $overtimeMultiplier;

    public function __construct()
    {
        $this->normalHours = config('worktime.normal_hours_monthly');
        $this->rate = config('worktime.hourly_rate');
        $this->overtimeMultiplier = config('worktime.overtime_multiplier');
    }

    public function getDailySummary(string $uuid, string $date): array
    {
        $employee = Employee::where('uuid', $uuid)->firstOrFail();

        $workTime = $employee->workTimes()->whereDate('work_day', $date)->first();

        if (!$workTime) {
            return ['message' => 'Brak danych dla wskazanego dnia.'];
        }

        $minutes = $workTime->started_at->diffInMinutes($workTime->ended_at);
        $hours = $this->roundToNearestHalfHour($minutes);

        return [
            'ilość godzin z danego dnia' => $hours,
            'stawka' => $this->rate . ' PLN',
            'suma po przeliczeniu' => ($hours * $this->rate) . ' PLN'
        ];
    }

    public function getMonthlySummary(string $uuid, string $date): array
    {
        $employee = Employee::where('uuid', $uuid)->firstOrFail();

        $workTimes = $employee->workTimes()
            ->whereYear('work_day', substr($date, 0, 4))
            ->whereMonth('work_day', substr($date, 5, 2))
            ->get();

        $totalMinutes = 0;

        foreach ($workTimes as $wt) {
            $totalMinutes += $wt->started_at->diffInMinutes($wt->ended_at);
        }

        $totalHours = $this->roundToNearestHalfHour($totalMinutes);

        $normalHours = min($totalHours, $this->normalHours);
        $overtimeHours = max($totalHours - $this->normalHours, 0);

        return [
            'ilość normalnych godzin z danego miesiąca' => $normalHours,
            'stawka' => $this->rate . ' PLN',
            'ilość nadgodzin z danego miesiąca' => $overtimeHours,
            'stawka nadgodzinowa' => ($this->rate * $this->overtimeMultiplier) . ' PLN',
            'suma po przeliczeniu' => ($normalHours * $this->rate + $overtimeHours * $this->rate * $this->overtimeMultiplier) . ' PLN',
        ];
    }

    private function roundToNearestHalfHour(int $minutes): float
    {
        $hours = $minutes / 60;
        return round($hours * 2) / 2;
    }
}
