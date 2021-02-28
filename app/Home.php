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
    public function getHomesByUserId(int $user_id)
    {
        return $this->select(['id','name','type','owner'])->where('owner', $user_id)->get()->toArray();
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getMainHomeByUserId(int $user_id)
    {
        return $this->select('id')
            ->where('owner',$user_id)
            ->where('main',true)
            ->get()
            ->toArray()[0]['id'];
    }
}
