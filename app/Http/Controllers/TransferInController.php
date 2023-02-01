<?php

namespace App\Http\Controllers;

use App\Models\TransferIn;
use Illuminate\Http\Request;

class TransferInController extends Controller
{
    public function transferIn()
    {
        $data = TransferIn::all();

        return view('user.transfer_in', ['transfer_in' => $data]);
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

        TransferIn::create($validated);

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

    public function delete(Request $request, TransferIn $transferIn)
    {
        $transferIn->delete();

        return redirect('/transfer_in')->with('message_delete', 'Successfully Deleted');
    }
}
