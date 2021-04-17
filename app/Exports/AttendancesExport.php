<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Attendance;
class AttendancesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Attendance::all();
    }
}
