<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        $this->authorize('companies.viewAny');

        return view('employee.companies.index');
    }

    public function create(): View
    {
        $this->authorize('companies.create');

        return view('employee.companies.create');
    }

    public function edit($id): View
    {
        $this->authorize('companies.edit');

        $company = Company::where('id', $id)->firstOrFail();

        return view('employee.companies.edit', ['company' => $company]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Company::class);

        $data = $request->validate([

        ]);

        return Company::create($data);
    }

    public function show(Company $company)
    {
        $this->authorize('view', $company);

        return $company;
    }

    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);

        $data = $request->validate([

        ]);

        $company->update($data);

        return $company;
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $company->delete();

        return response()->json();
    }
}
