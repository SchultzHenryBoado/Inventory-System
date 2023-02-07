<?php

namespace App\Http\Controllers;

use App\Exports\IssueExport;
use App\Models\Issue;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IssueController extends Controller
{
    public function issue()
    {
        $data = Issue::all();

        return view('user.issue', ['issue' => $data]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'issue_no' => 'required',
            'warehouse' => 'required',
            'date' => 'required',
            'reference' => 'required',
            'project_id' => 'required',
            'description' => 'required'
        ]);

        Issue::create([
            'issue_no' => $validated['issue_no'],
            'warehouse' => $validated['warehouse'],
            'date' => $validated['date'],
            'reference' => $validated['reference'],
            'project_id' => $validated['project_id'],
            'description' => $validated['description'],
            'users_id' => auth()->user()->id
        ]);

        return redirect('/issuance')->with('message', 'Created Successfully!');
    }

    public function update(Request $request, Issue $issue)
    {
        $validated = $request->validate([
            'issue_no' => 'required',
            'warehouse' => 'required',
            'date' => 'required',
            'reference' => 'required',
            'project_id' => 'required',
            'description' => 'required'
        ]);

        $issue->update($validated);

        return redirect('/issuance')->with('message_update', 'Updated Successfully!');
    }

    public function destroy(Issue $issue)
    {
        $issue->delete();

        return redirect('/issuance')->with('message_delete', 'Deleted Successfully!');
    }

    public function export()
    {
        return Excel::download(new IssueExport, 'Issue.xlsx');
    }
}
