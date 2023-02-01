<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function company()
    {
        $dataCompany = Company::all();

        return view('admin.company', ['company' => $dataCompany]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_code' => 'required',
            'company_name' => 'required'
        ]);

        Company::create($validated);

        return redirect('/company')->with('message', 'successfully created');
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
