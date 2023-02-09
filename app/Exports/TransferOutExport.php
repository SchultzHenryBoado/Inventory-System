<?php

namespace App\Exports;

use App\Models\TransferOut;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransferOutExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TransferOut::all();
    }

    public function map($row): array
    {
        return [
            $row->transfer_out_no,
            $row->date,
            $row->warehouse,
            $row->description
        ];

    }

    public function headings(): array
    {
        return [
            'TRANSFER OUT NO.',
            'DATE',
            'WAREHOUSE',
            'DESCRIPTION'
        ];
    }
}