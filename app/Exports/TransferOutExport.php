<?php

namespace App\Exports;

use App\Models\TransferOut;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransferOutExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TransferOut::all();
    }
}
