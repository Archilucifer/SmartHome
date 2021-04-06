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

    /**
     * @param int $home_id
     * @return array|array[]
     * @throws \JsonException
     */
    public function getLocalDevices(int $home_id): array
    {
        $roomsIds = $this->room->select(['id'])->where('home', $home_id)->get()->toArray();
        $registeredDevicesIp = $this->device->select(['ip'])->where('room', 'in', $roomsIds)->get()->toArray();

        $hostname = shell_exec('sudo hostname -I');
        $bash = sprintf('sudo nmap -sP %s/24 | grep -oE \'\b[0-9]{1,3}(\.[0-9]{1,3}){3}\b\'', trim($hostname));
        $localIps = explode(
            "\n",
            shell_exec($bash)
        );

        $devices = [];

        if (!empty($localIps[0])) {
            foreach ($localIps as $ip) {
                if (!in_array($ip, $registeredDevicesIp, true)) {
                    $ch = curl_init((string) $ip);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $response = json_decode(curl_exec($ch), true, 512, JSON_THROW_ON_ERROR);
                    if (is_array($response)){
                        $response['ip'] = $ip;
                        $devices[] = $response;
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
