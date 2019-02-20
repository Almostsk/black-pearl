<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersWithCodeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::whereHas('codes', function ($query){
                $query->where('expires_at', '>', Carbon::now());
            })
            ->select('id', 'name', 'surname', 'mobile_phone', 'created_at')
            ->distinct()
            ->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Імя',
            'Прізвище',
            'Телефон',
            'Дата реєстрації'
        ];
    }
}
