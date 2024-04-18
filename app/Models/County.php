<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class County extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
}
