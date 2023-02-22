<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ReceivingExport;
use App\Imports\ReceivingImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Receiving;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ReceivingController extends Controller
{
    public function index()
    {
        $data = Receiving::all();

        return view('user.receiving', ['receiving' => $data]);
    }

    public function store(Request $request, Receiving $receiving)
    {

        $validated = $request->validate([
            "receiving_no" => 'required',
            'warehouse' => 'required',
            "date" => 'required',
            "po_number" => 'required',
            "description" => 'required'
        ]);

        Receiving::create([
            'receiving_no' => $validated['receiving_no'],
            'warehouse' => $validated['warehouse'],
            'date' => $validated['date'],
            'po_number' => $validated['po_number'],
            'description' => $validated['description'],
            'users_id' => auth()->user()->id
        ]);

        return redirect('/receiving')->with('message', 'You created successfully!');
    }

    public function update(Request $request, Receiving $receiving)
    {
        $validated = $request->validate([
            'receiving_no' => 'required',
            'warehouse' => 'required',
            'date' => 'required',
            'po_number' => 'required',
            'description' => 'required',
        ]);

        $receiving->update($validated);

        return back()->with('message_update', 'You updated successfully!');
    }

    public function destroy(Receiving $receiving)
    {
        $receiving->delete();

        return back()->with('message_delete', 'You deleted successfully!');
    }

    public function export()
    {
        return Excel::download(new ReceivingExport, 'Receiving.csv');
    }

    public function import()
    {
        Excel::import(new ReceivingImport, request()->file('file'));

        return back()->with('success', 'Your file is imported successfully!');
    }
}