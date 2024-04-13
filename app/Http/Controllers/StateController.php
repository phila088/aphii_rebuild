<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class StateController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', State::class);

        return State::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', State::class);

        $data = $request->validate([

        ]);

        return State::create($data);
    }

    public function show(State $state)
    {
        $this->authorize('view', $state);

        return $state;
    }

    public function update(Request $request, State $state)
    {
        $this->authorize('update', $state);

        $data = $request->validate([

        ]);

        $state->update($data);

        return $state;
    }

    public function destroy(State $state)
    {
        $this->authorize('delete', $state);

        $state->delete();

        return response()->json();
    }
}
