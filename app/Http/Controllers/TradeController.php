<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Trade::class);

        return Trade::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Trade::class);

        $data = $request->validate([

        ]);

        return Trade::create($data);
    }

    public function show(Trade $trade)
    {
        $this->authorize('view', $trade);

        return $trade;
    }

    public function update(Request $request, Trade $trade)
    {
        $this->authorize('update', $trade);

        $data = $request->validate([

        ]);

        $trade->update($data);

        return $trade;
    }

    public function destroy(Trade $trade)
    {
        $this->authorize('delete', $trade);

        $trade->delete();

        return response()->json();
    }
}
