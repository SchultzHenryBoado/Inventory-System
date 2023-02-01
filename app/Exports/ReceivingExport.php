<?php

namespace App\Exports;

use App\Models\Receiving;
use Maatwebsite\Excel\Concerns\FromCollection;


class ReceivingExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Receiving::all();
    }
}
