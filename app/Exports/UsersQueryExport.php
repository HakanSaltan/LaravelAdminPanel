<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
class UsersQueryExport implements FromQuery
{
    public function __construct(int $limit)
    {
        $this->limit = $limit;
    }
    public function query()
    {
        return User::all()->limit($this->limit);
    }
}
