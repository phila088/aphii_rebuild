<?php

namespace App\Http\Controllers;

use App\Models\CompanyAddress;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CompanyAddressController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', CompanyAddress::class);

        return CompanyAddress::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', CompanyAddress::class);

        $data = $request->validate([

        ]);

        return CompanyAddress::create($data);
    }

    public function show(CompanyAddress $companyAddress)
    {
        $this->authorize('view', $companyAddress);

        return $companyAddress;
    }

    public function update(Request $request, CompanyAddress $companyAddress)
    {
        $this->authorize('update', $companyAddress);

        $data = $request->validate([

        ]);

        $companyAddress->update($data);

        return $companyAddress;
    }

    public function destroy(CompanyAddress $companyAddress)
    {
        $this->authorize('delete', $companyAddress);

        $companyAddress->delete();

        return response()->json();
    }
}
