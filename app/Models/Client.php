<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\ModelStatus\HasStatuses;

class Client extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable, HasStatuses;

    protected $fillable = [
        'created_by',
        'name',
        'dba',
        'abbreviation',
    ];
}
