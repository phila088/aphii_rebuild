<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Kalnoy\Nestedset\NodeTrait;

class Company extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable, NodeTrait;
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

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'parent_id');
    }
}
