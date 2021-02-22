<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'owner',
    ];

    public $timestamps = false;

    /**
     * @param int $user_id
     * @return Home[]|Collection
     */
    public function getHousesByUserId(int $user_id)
    {
        return $this->select(['id','name','type','owner'])->where('owner', $user_id)->get()->toArray();
    }
}
