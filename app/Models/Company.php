<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'dba',
        'created_by',
        'abbreviation',
        'iwo_prefix',
        'iwo_max_length',
        'iwo_postfix_increment',
        'logo_path',
        'deleted_at',
    ];
}
