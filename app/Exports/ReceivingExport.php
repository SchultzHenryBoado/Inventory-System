<?php

namespace App\Exports;

use App\Models\Receiving;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReceivingExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Receiving::all();
    }

    public function map($receiving): array
    {
         return [
            $receiving->receiving_no,
            $receiving->warehouse,
            $receiving->date,
            $receiving->po_number,
            $receiving->description
        ];
    }

    public function headings(): array
    {
        return [
            'RECEIVING_NO',
            'WAREHOUSE',
            'DATE',
            'P.O. NUMBER',
            'DESCRIPTION'
        ];
    }   
}