<?php

namespace App\Imports;

use App\Program;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class ProgramsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Program([
            'program_name' => $row['program_name'],
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time'],
            'duration'=>'',
            'presenter'=>$row['presenter'],
            'user_id'=> Auth::user()->id,
        ]);
    }
}
