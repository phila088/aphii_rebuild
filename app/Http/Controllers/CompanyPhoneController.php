<?php

namespace App\Http\Controllers;

use App\Models\CompanyPhone;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CompanyPhoneController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', CompanyPhone::class);

        return CompanyPhone::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', CompanyPhone::class);

        $data = $request->validate([

        ]);

        return CompanyPhone::create($data);
    }

    public function show(CompanyPhone $companyPhone)
    {
        $this->authorize('view', $companyPhone);

        return $companyPhone;
    }

    public function update(Request $request, CompanyPhone $companyPhone)
    {
        $this->authorize('update', $companyPhone);

        $data = $request->validate([

        ]);

        $companyPhone->update($data);

        return $companyPhone;
    }

    public function destroy(CompanyPhone $companyPhone)
    {
        $this->authorize('delete', $companyPhone);

        $companyPhone->delete();

        return response()->json();
    }
}
