<?php

namespace App\Http\Controllers;

use App\Models\ClientOnboarding;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ClientOnboardingController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', ClientOnboarding::class);

        return ClientOnboarding::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ClientOnboarding::class);

        $data = $request->validate([

        ]);

        return ClientOnboarding::create($data);
    }

    public function show(ClientOnboarding $clientOnboarding)
    {
        $this->authorize('view', $clientOnboarding);

        return $clientOnboarding;
    }

    public function update(Request $request, ClientOnboarding $clientOnboarding)
    {
        $this->authorize('update', $clientOnboarding);

        $data = $request->validate([

        ]);

        $clientOnboarding->update($data);

        return $clientOnboarding;
    }

    public function destroy(ClientOnboarding $clientOnboarding)
    {
        $this->authorize('delete', $clientOnboarding);

        $clientOnboarding->delete();

        return response()->json();
    }
}
