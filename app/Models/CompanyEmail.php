<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CompanyEmail extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'user_id',
        'company_id',
        'title',
        'email',
        'deleted_at',
    ];
}
