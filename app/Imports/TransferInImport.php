<?php

namespace App\Imports;

use App\Models\TransferIn;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;

class TransferInImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = auth()->user()->id;

        return new TransferIn([
            'transfer_in_no' => $row['transfer_in_no'],
            'reference_no' => $row['reference_no'],
            'date' => $row['date'],
            'warehouse' => $row['warehouse'],
            'description' => $row['description'],
            'users_id' => $user
        ]);
    }

    public function rules(): array
    {
        return [
            'transfer_in_no' => Rule::unique('transfer_ins', 'transfer_in_no')
        ];
    }
}