<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jamesh\Uuid\HasUuid;

class UserPermission extends Model
{
    use HasUuid;
    use SoftDeletes;

    protected $fillable = ['permission_id'];
    public $incrementing = false;
    protected $keyType = "string";
}
