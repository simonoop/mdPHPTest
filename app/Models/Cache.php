<?php
# app/Models/Cache.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Cache extends Model
{
    protected $table = "cache";
    protected $fillable = ['to', 'from', 'rate'];
}
