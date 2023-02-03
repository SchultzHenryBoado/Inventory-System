<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stocks()
    {
        $data = Stock::all();

        return view('admin.stock', ['stocks' => $data]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stock_code' => 'required',
            'description' => 'required',
            'uom' => 'required',
            'account_status' => 'required'
        ]);

        Stock::create($validated);

        return redirect('/stock')->with('message', 'Succesfully Created');
    }

    public function show($id)
    {
        $data = Stock::findOrFail($id);

        return view('admin.stock', ['stock' => $data]);
    }

    public function update(Request $request, Stock $stock)
    {
        $validated = $request->validate([
            'stock_code' => 'required',
            'description' => 'required',
            'uom' => 'required',
            'account_status' => 'required'
        ]);

        $stock->update($validated);

        return redirect('/stock')->with('message_update', 'Successfully Updated');
    }

    public function destroy(Request $request, Stock $stock)
    {
        $stock->delete();

        return redirect('/stock')->with('message_delete', 'Successfully Deleted');
    }
}
