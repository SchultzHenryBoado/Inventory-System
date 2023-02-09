<?php

namespace App\Exports;

use App\Models\TransferIn;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransferInExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TransferIn::all();
    }

    public function map($row): array
    {
        return[
            $row->transfer_in_no,
            $row->reference_no,
            $row->date,
            $row->warehouse,
            $row->description
        ];
    }

    public function headings(): array
    {
        return [
            'TRANSFER IN NO.',
            'REFERENCE NO.',
            'DATE',
            'WAREHOUSE',
            'DESCRIPTION'
        ];
    }
}