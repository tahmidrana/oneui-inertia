<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
// use Illuminate\Contracts\Queue\ShouldQueue;

class UsersImport implements ToModel, WithChunkReading, WithStartRow, WithLimit, SkipsEmptyRows
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'userid'=> $row[2],
            'name'=> $row[3],
            'phone'=> $row[4],
            'email'=> $row[5],
            'password' => Hash::make(env('USER_DEFAULT_PASSWORD'))
        ]);
    }

    public function startRow(): int
    {
        return 10;
    }

    public function limit(): int
    {
        return 200;
    }

    /* public function headingRow(): int
    {
        return 8;
    } */

    public function batchSize(): int
    {
        return 10;
    }

    public function chunkSize(): int
    {
        return 10;
    }
}
