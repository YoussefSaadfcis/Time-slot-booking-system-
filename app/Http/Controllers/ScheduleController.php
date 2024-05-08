<?php

namespace App\Http\Controllers;

use App\Imports\ScheduleImport;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class ScheduleController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Schedule::with(['service', 'branch']);

            if ($request->filled('from_date') && $request->filled('to_date')) {
                $fromDate = $request->from_date;
                $toDate = $request->to_date;
                $query->whereBetween('date', [$fromDate, $toDate]);
            }

            $data = $query->get();

            
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
        ;
        return view('schedule.index');
    }


    public function create()
    {
        return view("schedule.create");
    }

    public function store($excelDate, $jsonData)
    {

        $schedule = new Schedule();
        $schedule->data = json_encode($jsonData);
        $schedule->date = $excelDate;
        $schedule->organization_id = 1;
        $schedule->service_id = 1;
        $schedule->branch_id = 1;
        $schedule->save();
    }
    public function update($excelDate, $jsonData, $schedule)
    {


        $schedule->data = json_encode($jsonData);
        $schedule->date = $excelDate;
        $schedule->organization_id = 1;
        $schedule->service_id = 1;
        $schedule->branch_id = 1;
        $schedule->save();
    }

    public function  import(Request $request)
    {
        //validate file format 

        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);


        //handel excel sheet

        $import = new ScheduleImport;
        $schedule = Excel::toCollection($import, $request->file('file'));

        //it get[[[1,2,2,2],[5,5,5,5,5]]] (array of array of arrays 3d)
        $scheduleData = $schedule[0];

        //now we get[[5,5,5,5],[5,5,5,5]] (array of arrays  2d)


        // Assuming $scheduleData always has the same structure, with the first array being headers and the second being data
        for ($row = 1; $row < count($scheduleData); $row++) {
            $jsonData = [];
            if (is_null($scheduleData[$row][0])) {
                break;
            }
            for ($i = 1; $i < count($scheduleData[0]); $i++) {
                $key = $scheduleData[0][$i]; // Get the key from the first array
                $value = $scheduleData[$row][$i]; // Get the value from the second array
                $jsonData[$key] = $value; // Assign key-value pair to $jsonData
            }

            //handle date
            $excelDate = Carbon::createFromTimestamp(($scheduleData[$row][0] - 25569) * 86400)->format('Y-m-d');


            $exist = Schedule::where('date', $excelDate)->where('organization_id', 1)->where('service_id', 1)->where('branch_id', 1)->get();

            if ($exist->isEmpty()) {
                self::store($excelDate, $jsonData);
            } else {
                $firstMatch = $exist->first();
                self::update($excelDate, $jsonData, $firstMatch);
            }
        }

        return redirect()->route("service.index");
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id); // Find the Schedule model instance by ID
        $schedule->delete(); // Delete the instance

        // Store a success message in the session
        session()->flash('success', 'Schedule deleted successfully.');
        return redirect()->route('schedule.index');
    }
}
