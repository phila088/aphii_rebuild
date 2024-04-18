<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    use AuthorizesRequests;

    public function index(): View
    {
        $this->authorize('clients.viewAny');

        return view('employee.clients.index');
    }

    public function create(): View
    {
        $this->authorize('clients.create');

        return view('employee.clients.create');
    }

    public function edit($id): View
    {
        $this->authorize('clients.edit');

        $client = Client::where('id', $id)->firstOrFail();

        return view('employee.clients.edit', ['client' => $client]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Client::class);

        $data = $request->validate([

        ]);

        return Client::create($data);
    }

    public function show(Client $client)
    {
        $this->authorize('view', $client);

        return $client;
    }

    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        $data = $request->validate([

        ]);

        $client->update($data);

        return $client;
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();

        return response()->json();
    }
}
