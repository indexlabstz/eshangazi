<?php

namespace App\Nova\Metrics;

use App\Member;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class MemberCount extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param Request $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->count($request, Member::class);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30 => '30 Days',
            60 => '60 Days',
            365 => '365 Days',
            'MTD' => 'Month To Date',
            'QTD' => 'Quarter To Date',
            'YTD' => 'Year To Date',
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return void
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'member-count';
    }
}
