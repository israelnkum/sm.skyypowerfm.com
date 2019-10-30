<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all(['name','username','email','phone_number','role']);
    }
    public function headings(): array
    {
        // TODO: Implement headings() method.
        return ["Name",'Username',"Email", "Phone Number","Role"];
    }
}
