<?php

namespace App\Imports;

use App\Models\TransferOut;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;

class TransferOutImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = auth()->user()->id;
        
        return new TransferOut([
            'transfer_out_no' => $row['transfer_out_no'],
            'date' => $row['date'],
            'warehouse' => $row['warehouse'],
            'description' => $row['description'],
            'users_id' => $user
        ]);
    }

    public function rules(): array
    {
       return [
        'transfer_out_no' => Rule::unique('transfer_outs', 'transfer_out_no')
       ];
    }
}