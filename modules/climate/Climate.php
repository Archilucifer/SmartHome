<?php

namespace modules\climate;

class Climate
{
    /**
     * @var float
     */
    public $temp;

    /**
     * @var float
     */
    public $humidity;

    /**
     * @var integer
     */
    public $floor;

    /**
     * Climate constructor.
     * @param float $temp
     * @param float $humidity
     * @param int $floor
     */
    public function __construct(float $temp, float $humidity, int $floor)
    {
        $this->temp = $temp;
        $this->humidity = $humidity;
        $this->floor = $floor;
    }
}
