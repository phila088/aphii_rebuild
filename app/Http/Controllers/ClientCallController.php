<?php

namespace App\Http\Controllers;

use App\Models\ClientCall;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ClientCallController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', ClientCall::class);

        return ClientCall::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ClientCall::class);

        $data = $request->validate([

        ]);

        return ClientCall::create($data);
    }

    public function show(ClientCall $clientCall)
    {
        $this->authorize('view', $clientCall);

        return $clientCall;
    }

    public function update(Request $request, ClientCall $clientCall)
    {
        $this->authorize('update', $clientCall);

        $data = $request->validate([

        ]);

        $clientCall->update($data);

        return $clientCall;
    }

    public function destroy(ClientCall $clientCall)
    {
        $this->authorize('delete', $clientCall);

        $clientCall->delete();

        return response()->json();
    }
}
