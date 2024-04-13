<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'active',
        'locked',
        'client',
        'employee',
        'technician',
        'created_by',
        'email_verified_at',
        'vendor',
        'remember_token',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function clientBillingInstructions(): HasMany
    {
        return $this->hasMany(ClientBillingInstruction::class);
    }

    public function clientCalls(): HasMany
    {
        return $this->hasMany(ClientCall::class);
    }

    public function clientContacts(): HasMany
    {
        return $this->hasMany(ClientContact::class);
    }

    public function clientContracts(): HasMany
    {
        return $this->hasMany(ClientContract::class);
    }

    public function clientNotes(): HasMany
    {
        return $this->hasMany(ClientNote::class);
    }

    public function clientOnboardings(): HasMany
    {
        return $this->hasMany(ClientOnboarding::class);
    }

    public function clientPortals(): HasMany
    {
        return $this->hasMany(ClientPortal::class);
    }

    public function clientRates(): HasMany
    {
        return $this->hasMany(ClientRate::class);
    }

    public function clientServiceCharges(): HasMany
    {
        return $this->hasMany(ClientServiceCharge::class);
    }

    public function company(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }
}
