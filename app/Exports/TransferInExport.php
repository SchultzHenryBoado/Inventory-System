<?php

namespace App\Exports;

use App\Models\TransferIn;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransferInExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TransferIn::all();
    }
}
