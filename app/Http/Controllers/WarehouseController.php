<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $dataWarehouse = Warehouse::all();

        return view('admin.warehouse', [
            'warehouse' => $dataWarehouse
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'warehouse_code' => 'required',
            'warehouse_name' => 'required'
        ]);

        Warehouse::create($validated);

        return redirect('/warehouse')->with('message', 'You created successfully!');
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'warehouse_code' => 'required',
            'warehouse_name' => 'required'
        ]);

        $warehouse->update($validated);

        return redirect('/warehouse')->with('message_update', 'You updated successfully!');

    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        return redirect('/warehouse')->with('message_delete', 'You deleted successfully!');
    }
    
}
