<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientContact extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'client_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'phone_extension',
        'position',
        'primary',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
