<?php

namespace App\Helpers;

use App\Device;
use App\Room;

class Devices
{

    /**
     * @var Room $room
     */
    private $room;

    /**
     * @var Device $device
     */
    private $device;

    /**
     * Devices constructor.
     * @param Room $room
     * @param Device $device
     */
    public function __construct(Room $room, Device $device)
    {
        $this->room = $room;
        $this->device = $device;
    }

    public function getLocalDevices(int $home_id)
    {
        $roomsIds = $this->room->select(['id'])->where('home', $home_id)->get()->toArray();
        $registeredDevicesIp = $this->device->select(['ip'])->where('room', 'in', $roomsIds)->get()->toArray();

        $hostname = shell_exec('sudo hostname -I');
        $localIps = explode(
            "\n",
            shell_exec(sprintf('sudo nmap -sP %s/24 | grep -oE \'\b[0-9]{1,3}(\.[0-9]{1,3}){3}\b\'', $hostname)));

        $devices = [];
        if (!empty($localIps[0])) {
            foreach ($localIps as $ip) {
                if (!in_array($ip, $registeredDevicesIp, true)) {
                    $ch = curl_init($ip.'/login/');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $response = curl_exec($ch);
                    if (is_array($response)){
                        $response['ip'] = $ip;
                        $devices[][] = $response;
                    }
                    continue ;
                }
            }
        } else {
            $devices['message'] = "No available devices were detected";
            return [$devices];
        }

        if(empty($devices)){
            $devices['message'] = "No smart devices were detected";
            return [$devices];
        }

        return $devices;
    }
}
