<?php

namespace App\Http\Controllers;

use App\Exports\TransferInExport;
use App\Imports\TransferInImport;
use App\Models\TransferIn;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransferInController extends Controller
{
    public function index()
    {
        $data = TransferIn::all();
        $dataWarehouse = Warehouse::all();

        return view('user.transfer_in', [
            'transfer_in' => $data,
            'warehouse' => $dataWarehouse
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transfer_in_no' => 'required',
            'reference_no' => 'required',
            'date' => 'required',
            'warehouse' => 'required',
            'description' => 'required'
        ]);

        TransferIn::create([
            'transfer_in_no' => $validated['transfer_in_no'],
            'reference_no' => $validated['reference_no'],
            'date' => $validated['date'],
            'warehouse' => $validated['warehouse'],
            'description' => $validated['description'],
            'users_id' => auth()->user()->id
        ]);

        return redirect('/transfer_in')->with('message', 'Successfully Created');
    }

    public function update(Request $request, TransferIn $transferIn)
    {
        $validated = $request->validate([
            'transfer_in_no' => 'required',
            'reference_no' => 'required',
            'date' => 'required',
            'warehouse' => 'required',
            'description' => 'required'
        ]);

        $transferIn->update($validated);

        return redirect('/transfer_in')->with('message_update', 'Successfully Updated');
    }

    public function destroy(Request $request, TransferIn $transferIn)
    {
        $transferIn->delete();

        return redirect('/transfer_in')->with('message_delete', 'Successfully Deleted');
    }

    public function export_excel()
    {
        return Excel::download(new TransferInExport, 'Transfer_in.csv');
    }

    public function import()
    {
        Excel::import(new TransferInImport, request()->file('file'));

        return back()->with('success', 'Your file is imported successfully');
    }
}