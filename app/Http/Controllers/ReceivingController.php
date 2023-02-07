<?php

namespace App\Http\Controllers;

use App\Models\Receiving;
use Illuminate\Http\Request;
use App\Exports\ReceivingExport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReceivingController extends Controller
{
    public function receive()
    {
        $data = Receiving::all();

        return view('user.receiving', ['receive' => $data]);
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

        return redirect('/receiving')->with('message', 'Created successfully');
    }

    public function update(Request $request, Receiving $receiving)
    {

        $validated = $request->validate([
            "receiving_no" => 'required',
            'warehouse' => 'required',
            "date" => 'required',
            "po_number" => 'required',
            "description" => 'required',
        ]);

        $receiving->update($validated);

        return redirect('/receiving')->with('message_update', 'Successfully Updated');
    }

    public function destroy(Request $request, Receiving $receiving)
    {
        $receiving->delete();

        return redirect('/receiving')->with('message_delete', 'Successfully Deleted');
    }

    public function export()
    {
        return Excel::download(new ReceivingExport, 'Receiving.xlsx');
    }
}
