<?php

namespace App\Http\Controllers;

use App\Models\ClientServiceCharge;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ClientServiceChargeController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', ClientServiceCharge::class);

        return ClientServiceCharge::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ClientServiceCharge::class);

        $data = $request->validate([

        ]);

        return ClientServiceCharge::create($data);
    }

    public function show(ClientServiceCharge $clientServiceCharge)
    {
        $this->authorize('view', $clientServiceCharge);

        return $clientServiceCharge;
    }

    public function update(Request $request, ClientServiceCharge $clientServiceCharge)
    {
        $this->authorize('update', $clientServiceCharge);

        $data = $request->validate([

        ]);

        $clientServiceCharge->update($data);

        return $clientServiceCharge;
    }

    public function destroy(ClientServiceCharge $clientServiceCharge)
    {
        $this->authorize('delete', $clientServiceCharge);

        $clientServiceCharge->delete();

        return response()->json();
    }
}
