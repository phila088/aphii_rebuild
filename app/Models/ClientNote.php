<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientNote extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
}
