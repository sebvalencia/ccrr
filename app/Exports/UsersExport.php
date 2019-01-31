<?php 

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\User;


class UsersExport implements FromCollection
{
    public function collection()
    {
        return User::all();
        //return factory ('App\User',10)->make();
    }
}