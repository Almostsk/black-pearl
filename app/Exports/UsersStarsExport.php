<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersStarsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::join('statuses', 'statuses.id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.surname', 'users.mobile_phone', 'users.created_at', 'statuses.name AS status_name')
            ->where([
                ['status_id', User::STATUS_ACCEPTED],
                ['can_be_brand_face', true]
            ])
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
