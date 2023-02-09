<?php

namespace App\Exports;

use App\Models\Issue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IssueExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Issue::all();
    }

    public function map($row): array
    {
        return [
           $row->issue_no,
           $row->warehouse,
           $row->date,
           $row->reference,
           $row->project_id,
           $row->description
        ];
    }
   
    public function headings(): array
    {
        return[
            'ISSUE NO',
            'WAREHOUSE',
            'DATE',
            'REFERENCE',
            'PROJECT ID',
            'DESCRIPTION'
        ];
    }
}