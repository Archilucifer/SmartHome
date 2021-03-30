<?php

namespace App\Http\Controllers;

use App\Home;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function homeCreate(Request $request): RedirectResponse
    {
        $params = $request->all();

        $this->home->create($this->prepareParams($params, auth()->user()->id));

        return back();
    }

    /**
     * @param array $params
     * @param int $user_id
     * @return array
     */
    private function prepareParams(array $params, int $user_id): array
    {
        $params = Arr::add($params, 'owner', $user_id);
        $params['main'] = $params['main'] ? 1 : 0;
        unset($params['_token']);

        return $params;
    }
}
