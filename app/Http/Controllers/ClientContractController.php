<?php

namespace App\Http\Controllers;

use App\Models\ClientContract;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ClientContractController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', ClientContract::class);

        return ClientContract::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ClientContract::class);

        $data = $request->validate([

        ]);

        return ClientContract::create($data);
    }

    public function show(ClientContract $clientContract)
    {
        $this->authorize('view', $clientContract);

        return $clientContract;
    }

    public function update(Request $request, ClientContract $clientContract)
    {
        $this->authorize('update', $clientContract);

        $data = $request->validate([

        ]);

        $clientContract->update($data);

        return $clientContract;
    }

    public function destroy(ClientContract $clientContract)
    {
        $this->authorize('delete', $clientContract);

        $clientContract->delete();

        return response()->json();
    }
}
