<?php

namespace App\Http\Controllers;

use App\Home;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Expression;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        $homes = $this->home->getHousesByUserId(auth()->user()->id);
        return view('home',['data'=>$homes]);
    }

    public function homeCreate(Request $request)
    {
        $user_id = auth()->user()->id;
        $params = $request->all();
        $params = array_add($params, 'owner', $user_id);

        unset($params['_token']);

        $this->home->create($params);

        $homes = $this->home->getHousesByUserId(auth()->user()->id);
        return view('home',['data'=>$homes]);
    }
}