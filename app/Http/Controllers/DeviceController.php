<?php

namespace App\Http\Controllers;

use App\Device;
use App\Helpers\Devices;
use App\Home;
use App\Room;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeviceController extends Controller
{
    /* @var Device $device */
    private $device;

    /* @var Room $room */
    private $room;

    /* @var Home $home */
    private $home;

    /**
     * DeviceController constructor.
     * @param Device $device
     * @param Room $room
     * @param Home $home
     */
    public function __construct(Device $device, Room $room, Home $home)
    {
        $this->device = $device;
        $this->room = $room;
        $this->home = $home;
        $this->middleware('auth');
    }

    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $mainHome = $this->home->getMainHomeByUserId($userId);

        $devices = $this->device->getDevicesIpByHomeId($mainHome);
        $homes = $this->home->select(['id','name'])->where('owner', $userId)->get()->toArray();
        $rooms = [];
        foreach ($homes as $home){
            $rooms[$home['id']] = $this->room->select(['id','name'])->where('home', $home['id'])->get()->toArray();
        }

        return view('device',['data'=>$devices, 'homeId'=>$mainHome, 'rooms'=>$rooms, 'homes'=>$homes]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function deviceCreate(Request $request)
    {
        $params = $request->all();

        $this->device->create($params);

        return back();
    }

    /**
     * @param int $homeId
     * @return false|string
     * @throws \JsonException
     */
    public function scan(int $homeId) {
        $devices = new Devices($this->room, $this->device);
        return json_encode($devices->getLocalDevices($homeId), JSON_THROW_ON_ERROR);
    }
}
