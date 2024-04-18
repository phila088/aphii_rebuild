<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    public function state(): BelongsTo
    {
        return $this->belongsTo(States::class);
    }
}
