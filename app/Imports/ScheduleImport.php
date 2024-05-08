<?php

namespace App\Imports;

use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
//########################## not used ###############################W

class ScheduleImport implements ToCollection
{

    public function collection(Collection $rows)
    {
        
        $headers = $rows[0]->toArray(); // Convert headers to array
        $values = $rows[1]->toArray(); // Convert values to array
        $data = [];

        // Start the loop from index 1 to exclude the first column
        for ($index = 1; $index < count($headers); $index++) {
            // Get the key from headers array
            $key = $headers[$index];
            // Get the value from values array
            $value = $values[$index];

            // Add key-value pair to the data array
            $data[$key] = $value;
        }
        $schedule= new Schedule([
            'date' => $values[0],
            'data' => $data,

        ]);
        
        return $schedule;
    }
}
