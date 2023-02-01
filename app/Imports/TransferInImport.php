<?php

namespace App\Imports;

use App\Models\TransferIn;
use Maatwebsite\Excel\Concerns\ToModel;

class TransferInImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new TransferIn([]);
    }
}
