<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Certification::class);

        return Certification::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Certification::class);

        $data = $request->validate([

        ]);

        return Certification::create($data);
    }

    public function show(Certification $certification)
    {
        $this->authorize('view', $certification);

        return $certification;
    }

    public function update(Request $request, Certification $certification)
    {
        $this->authorize('update', $certification);

        $data = $request->validate([

        ]);

        $certification->update($data);

        return $certification;
    }

    public function destroy(Certification $certification)
    {
        $this->authorize('delete', $certification);

        $certification->delete();

        return response()->json();
    }
}
