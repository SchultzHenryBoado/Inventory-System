<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_code' => 'required',
            'company_name' => 'required'
        ]);

        Company::create($validated);

        return redirect('/company')->with('message', 'successfully created');
    }

    public function storeId($id)
    {
        $data = Company::findOrFail($id);

        return view('/company', ['company' => $data]);
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'company_code' => ['required'],
            'company_name' => ['required']
        ]);

        $company->update($validated);

        return redirect('/company')->with('message_update', 'Update successfully');
    }

    public function destroy(Request $request, Company $company)
    {
        $company->delete();

        return redirect('/company')->with('message_delete', 'Successfully Deleted');
    }
}
