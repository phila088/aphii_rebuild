<?php

namespace App\Http\Controllers;

use App\Models\County;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CountyController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', County::class);

        return County::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', County::class);

        $data = $request->validate([

        ]);

        return County::create($data);
    }

    public function show(County $county)
    {
        $this->authorize('view', $county);

        return $county;
    }

    public function update(Request $request, County $county)
    {
        $this->authorize('update', $county);

        $data = $request->validate([

        ]);

        $county->update($data);

        return $county;
    }

    public function destroy(County $county)
    {
        $this->authorize('delete', $county);

        $county->delete();

        return response()->json();
    }
}
