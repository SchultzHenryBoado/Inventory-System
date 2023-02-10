<?php

namespace App\Imports;

use App\Models\Issue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class IssueImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = auth()->user()->id;

        return new Issue([
            'users_id' => $user,
            'issue_no' => $row['issue_no'],
            'warehouse' => $row['warehouse'],
            'date' => $row['date'],
            'reference' => $row['reference'],
            'project_id' => $row['project_id'],
            'description' => $row['description']
        ]);
    }

    public function rules(): array
    {
        return[
            'issue_no' => Rule::unique('issues', 'issue_no')
        ];
    }


}