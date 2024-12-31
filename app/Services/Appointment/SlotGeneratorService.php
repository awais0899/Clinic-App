<?php

namespace App\Services\Appointment;

use Carbon\Carbon;

class SlotGeneratorService
{
    public function generateSlots($clinic, $date)
    {
        $date = Carbon::parse($date);
        $slots = [];
    
        // Assuming clinic has opening and closing times
        $openingTime = $clinic->opening_time ?? '09:00'; // Default 9 AM
        $closingTime = $clinic->closing_time ?? '17:00'; // Default 5 PM
    
        $start = $date->copy()->setTimeFromTimeString($openingTime);
        $end = $date->copy()->setTimeFromTimeString($closingTime);
    
        while ($start->lt($end)) {
            // Format the time slot
            $slots[] = $start->format('H:i');
            $start->addMinutes(30); // 30-minute intervals
        }
    
        return $slots;
    }
    
}