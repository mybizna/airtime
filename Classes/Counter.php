<?php

namespace Modules\Airtime\Classes;

use Modules\Airtime\Entities\Airtime;
use Modules\Airtime\Entities\Phone;
use Modules\Airtime\Entities\Number;
use Carbon\Carbon;

class Counter
{
    public function requirementCounter($level, $resource, $affiliate)
    {
        $isValid = false;
        $message = 'Your Account did not meet the requirement.';

        $maxLevel = config('global_preferences.airtime__phone_not_set_max_level');
        $noOfDays = $resource->requirement_no_of_days;

        $phone = Phone::where('partner_id', $affiliate->partner_id)->first();
        $number = Number::where('partner_id', $affiliate->partner_id)->first();

        if ($phone && $number) {
            $endDate = Carbon::now();
            $startDate = $endDate->subDays((int)$noOfDays);

            $totalAmount = Airtime::where('phone', $number->phone)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->sum('amount');

            if (!is_null($totalAmount) && $totalAmount >= $resource->requirement_amount) {
                $isValid = true;
                $message = 'Your account is complete and has a GIF Number';
            }

            if ($level <= $maxLevel) {
                $isValid = true;
            } else {
                $isValid = false;
            }
        }

        return [$isValid, $message];
    }
}
