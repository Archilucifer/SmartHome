<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Device
 * @package App
 * @mixin Builder
 */
class Device extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip', 'name', 'icon_class', 'room', 'home'
    ];

    public $timestamps = false;

    /**
     * @param int $home_id
     * @return Device[]|Collection
     */
    public function getDevicesIpByHomeId(int $home_id)
    {
        return $this->select(['name','icon_class'])->where('home', $home_id)->get()->toArray();
    }
}
