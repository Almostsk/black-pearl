<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::join('statuses', 'statuses.id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.surname', 'users.mobile_phone', 'users.created_at', 'statuses.name AS status_name')
            ->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Імя',
            'Прізвище',
            'Телефон',
            'Дата реєстрації',
            'Статус'
        ];
    }
}
