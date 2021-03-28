<?php

namespace App\Http\Controllers;

use App\Home;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * @var Home $home
     */
    private $home;

    /**
     * HomeController constructor.
     * @param Home $home
     */
    public function __construct(Home $home)
    {
        $this->home = $home;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Factory|Application|View
     */
    public function index()
    {
        $homes = $this->home->getHomesByUserId(auth()->user()->id);
        return view('home',['data'=>$homes]);
    }

    public function homeCreate(Request $request)
    {
        $user_id = auth()->user()->id;
        $params = $request->all();
        $params = Arr::add($params, 'owner', $user_id);

        unset($params['_token']);

        $this->home->create($params);

        return back();
    }
}
