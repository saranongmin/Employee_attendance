<?php

namespace App\Exports;

use App\User;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Id',
            'name',
            'email',
            'createdAt',
            'updatedAt',
        ];
    }
 public function query()
    {
        return User::query();
        /*you can use condition in query to get required result
         return Bulk::query()->whereRaw('id > 5');*/
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            Date::dateTimeToExcel($user->created_at),
            Date::dateTimeToExcel($user->updated_at),
        ];
    }

}
