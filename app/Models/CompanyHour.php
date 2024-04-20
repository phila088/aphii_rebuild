<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CompanyHour extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'company_id',
        'title',
        'timezone',
        'monday_open',
        'monday_close',
        'tuesday_open',
        'tuesday_close',
        'wednesday_open',
        'wednesday_close',
        'thursday_open',
        'thursday_close',
        'friday_open',
        'friday_close',
        'saturday_open',
        'saturday_close',
        'sunday_open',
        'sunday_close',
    ];
}
