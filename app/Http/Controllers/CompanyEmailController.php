<?php

namespace App\Http\Controllers;

use App\Models\CompanyEmail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CompanyEmailController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', CompanyEmail::class);

        return CompanyEmail::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', CompanyEmail::class);

        $data = $request->validate([

        ]);

        return CompanyEmail::create($data);
    }

    public function show(CompanyEmail $companyEmail)
    {
        $this->authorize('view', $companyEmail);

        return $companyEmail;
    }

    public function update(Request $request, CompanyEmail $companyEmail)
    {
        $this->authorize('update', $companyEmail);

        $data = $request->validate([

        ]);

        $companyEmail->update($data);

        return $companyEmail;
    }

    public function destroy(CompanyEmail $companyEmail)
    {
        $this->authorize('delete', $companyEmail);

        $companyEmail->delete();

        return response()->json();
    }
}
