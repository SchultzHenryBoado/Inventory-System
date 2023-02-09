<?php

namespace App\Imports;

use App\Models\Receiving;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ReceivingImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = auth()->user()->id;

        return new Receiving([
            'receiving_no' => $row['receiving_no'],
            'warehouse' => $row['warehouse'],
            'date' => $row['date'],
            'po_number' => $row['po_number'],
            'description' => $row['description'],
            'users_id' => $user
        ]);
    }

    public function rules(): array
    {
        return [
            'receiving_no' => ['unique:receivings,receiving_no']
        ];
    }

}