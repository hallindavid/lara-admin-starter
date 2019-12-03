<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['title', 'description'];
    protected $table = "permission";
    public $timestamps = false;
}
