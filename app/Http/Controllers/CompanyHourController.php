<?php

namespace App\Http\Controllers;

use App\Models\CompanyHour;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CompanyHourController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', CompanyHour::class);

        return CompanyHour::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', CompanyHour::class);

        $data = $request->validate([

        ]);

        return CompanyHour::create($data);
    }

    public function show(CompanyHour $companyHour)
    {
        $this->authorize('view', $companyHour);

        return $companyHour;
    }

    public function update(Request $request, CompanyHour $companyHour)
    {
        $this->authorize('update', $companyHour);

        $data = $request->validate([

        ]);

        $companyHour->update($data);

        return $companyHour;
    }

    public function destroy(CompanyHour $companyHour)
    {
        $this->authorize('delete', $companyHour);

        $companyHour->delete();

        return response()->json();
    }
}
