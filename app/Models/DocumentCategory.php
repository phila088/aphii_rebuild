<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;
use OwenIt\Auditing\Contracts\Auditable;

class DocumentCategory extends Model implements Auditable
{
    use SoftDeletes, \OwenIt\Auditing\Auditable, NodeTrait;

    protected $fillable = ['name', 'parent_id'];
}
