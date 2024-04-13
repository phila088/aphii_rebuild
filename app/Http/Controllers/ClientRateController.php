<?php

namespace App\Http\Controllers;

use App\Models\ClientRate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ClientRateController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', ClientRate::class);

        return ClientRate::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ClientRate::class);

        $data = $request->validate([

        ]);

        return ClientRate::create($data);
    }

    public function show(ClientRate $clientRate)
    {
        $this->authorize('view', $clientRate);

        return $clientRate;
    }

    public function update(Request $request, ClientRate $clientRate)
    {
        $this->authorize('update', $clientRate);

        $data = $request->validate([

        ]);

        $clientRate->update($data);

        return $clientRate;
    }

    public function destroy(ClientRate $clientRate)
    {
        $this->authorize('delete', $clientRate);

        $clientRate->delete();

        return response()->json();
    }
}
