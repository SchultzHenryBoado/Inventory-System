<?php

namespace App\Http\Controllers;

use App\Exports\TransferOutExport;
use App\Imports\TransferOutImport;
use App\Models\Receiving;
use App\Models\TransferOut;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransferOutController extends Controller
{
    public function transferOut()
    {
        $data = TransferOut::all();

        return view('user.transfer_out', ['transfer_out' => $data]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transfer_out_no' => 'required',
            'date' => 'required',
            'warehouse' => 'required',
            'description' => 'required'
        ]);

        TransferOut::create([
            'transfer_out_no' => $validated['transfer_out_no'],
            'date' => $validated['date'],
            'warehouse' => $validated['warehouse'],
            'description' => $validated['description'],
            'users_id' => auth()->user()->id
        ]);

        return redirect('/transfer_out')->with('message', 'Successfully Created');
    }

    public function update(Request $request, TransferOut $transferOut)
    {
        $validated = $request->validate([
            'transfer_out_no' => 'required',
            'date' => 'required',
            'warehouse' => 'required',
            'description' => 'required'
        ]);

        $transferOut->update($validated);

        return redirect('/transfer_out')->with('message_update', 'Updated successfully');
    }

    public function destroy(TransferOut $transferOut)
    {
        $transferOut->delete();

        return redirect('/transfer_out')->with('message_delete', 'Deleted successfully');
    }

    public function export()
    {
        return Excel::download(new TransferOutExport, 'Transfer_out.csv');
    }

    public function import() 
    {
        Excel::import(new TransferOutImport, request()->file('file'));

        return back()->with('success', 'Your file is imported successfully!');
    }
}