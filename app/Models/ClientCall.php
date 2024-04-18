<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientCall extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'created_by',
        'client_id',
        'client_contact_id',
        'call_date',
        'notes',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function clientContact(): BelongsTo
    {
        return $this->belongsTo(ClientContact::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
