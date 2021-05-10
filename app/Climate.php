<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Device
 * @package App
 * @mixin Builder
 */
class Climate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'temp', 'humidity'
    ];

    public $timestamps = false;
}
