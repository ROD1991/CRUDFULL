<?php

namespace App\Exports;

use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'regis',
            'fecha',
            'rut',
            'personal',
            'estado',
            'condicion'
        ];
    }
    public function collection()
    {
         $users = DB::table('registros')->select('regis','fecha', 'rut','personal','estado','condicion',)->get();
         return $users;
        
    }
}