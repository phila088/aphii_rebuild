<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\ContactPosition;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\States;
use App\Models\StatusCode;
use App\Policies\ContactPositionPolicy;
use App\Policies\DocumentCategoryPolicy;
use App\Policies\DocumentPolicy;
use App\Policies\StatesPolicy;
use App\Policies\StatusCodePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        States::class => StatesPolicy::class,
        StatusCode::class => StatusCodePolicy::class,
        ContactPosition::class => ContactPositionPolicy::class,
        DocumentCategory::class => DocumentCategoryPolicy::class,
        Document::class => DocumentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
