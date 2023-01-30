<?php

namespace App\Http\Controllers;

use App\Models\Receiving;
use Illuminate\Http\Request;

class ReceivingController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            "receiving_no" => 'required',
            'warehouse' => 'required',
            "date" => 'required',
            "po_number" => 'required',
            "description" => 'required'
        ]);

        Receiving::create($validated);

        return redirect('/receiving')->with('message', 'Created successfully');
    }

    public function storeId($id)
    {
        $dataId = Receiving::findOrFail($id);

        return view('user.receiving', ['receive' => $dataId]);
    }

    public function update(Request $request, Receiving $receiving)
    {
        $validated = $request->validate([
            "receiving_no" => 'required',
            'warehouse' => 'required',
            "date" => 'required',
            "po_number" => 'required',
            "description" => 'required'
        ]);

        $receiving->update($validated);

        return redirect('/receiving')->with('message_update', 'Update successfully');
    }
}
