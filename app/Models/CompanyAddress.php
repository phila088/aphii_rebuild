<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CompanyAddress extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'user_id',
        'company_id',
        'title',
        'building_number',
        'pre_direction',
        'street_name',
        'street_type',
        'post_direction',
        'unit_type',
        'unit',
        'po_box',
        'city',
        'state',
        'zip',
        'deleted_at',
    ];
}
