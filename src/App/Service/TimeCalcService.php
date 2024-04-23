<?php

namespace App\Service;

class TimeCalcService
{

    /**
     * @param $startDate
     * @param $endDate
     * @return string
     */
    public function diffMinutes($startDate, $endDate): string
    {
        $diff = $endDate->diff($startDate);
        return (empty($diff->format('%r')) ? '+' : $diff->format('%r')) . ($diff->h * 60 + $diff->i);
    }
}