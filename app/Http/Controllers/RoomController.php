<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index(int $id)
    {
        $rooms = $this->room->getRoomsByHomeId($id);
        return view('rooms',['data'=>$rooms, 'homeId'=>$id]);
    }

    public function roomCreate(Request $request, int $id)
    {
        $params = $request->all();
        $params = array_add($params, 'home', $id);

        unset($params['_token']);

        $this->room->create($params);

        return back();
    }
}
