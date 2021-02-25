<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'home',
    ];

    public $timestamps = false;

    /**
     * @param int $home_id
     * @return Room[]|Collection
     */
    public function getRoomsByHomeId(int $home_id)
    {
        return $this->select(['id','name','type'])->where('home', $home_id)->get()->toArray();
    }

    public static function getRoomTypes(): array
    {
        return [
            'BedRoom',
            'BathRoom',
            'LivingRoom',
            'Study',
            'Kitchen',
            'DiningRoom',
            'Hall',
            'Corridor',
            'Attic',
            'Garage',
            'Yard',
        ];
    }
}
