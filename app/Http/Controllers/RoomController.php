<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class RoomController extends Controller
{
    /**
     * @var Room $room
     */
    private $room;


    /**
     * HomeController constructor.
     * @param Room $room
     */
    public function __construct(Room $room)
    {
        $this->room = $room;
        $this->middleware('auth');
    }

    /**
     * @param int $id
     * @return Factory|Application|View
     */
    public function index(int $id)
    {
        $rooms = $this->room->getRoomsByHomeId($id);
        return view('rooms',['data'=>$rooms, 'homeId'=>$id]);
    }

    public function roomCreate(Request $request, int $id)
    {
        $params = $request->all();
        $params = Arr::add($params, 'home', $id);

        unset($params['_token']);

        $this->room->create($params);

        return back();
    }
}
