<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', UserProfile::class);

        return UserProfile::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', UserProfile::class);

        $data = $request->validate([

        ]);

        return UserProfile::create($data);
    }

    public function show(UserProfile $userProfile)
    {
        $this->authorize('view', $userProfile);

        return $userProfile;
    }

    public function update(Request $request, UserProfile $userProfile)
    {
        $this->authorize('update', $userProfile);

        $data = $request->validate([

        ]);

        $userProfile->update($data);

        return $userProfile;
    }

    public function destroy(UserProfile $userProfile)
    {
        $this->authorize('delete', $userProfile);

        $userProfile->delete();

        return response()->json();
    }
}
