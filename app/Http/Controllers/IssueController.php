<?php

namespace App\Http\Controllers;

use App\Exports\IssueExport;
use App\Imports\IssueImport;
use App\Models\Issue;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IssueController extends Controller
{
    public function index()
    {
        $data = Issue::all();
        $dataWarehouse = Warehouse::all();

        return view('user.issue', [
            'issue' => $data,
            'warehouse' => $dataWarehouse
        ]);
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

        return redirect('/issuance')->with('message', 'You created successfully!');
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
        return Excel::download(new IssueExport, 'Issue.csv');
    }

    public function import()
    {
        Excel::import(new IssueImport, request()->file('file'));

        return back()->with('success', 'Your file is imported successfully!');
    }
}