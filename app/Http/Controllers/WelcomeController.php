<?php

namespace App\Http\Controllers;

use App\Climate;
use App\Device;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * WelcomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Factory|Application|View
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function getClimateDate(Request $request)
    {
        $params = $request->all();

        $climate = new Climate();

        $climateModel = $climate->select(['id'])->where('name', $params['name'])->get()[0];
        if ($climateModel !== null){
            $climateModel->update($params);
            $climateModel->save();
            return true;
        }
        $climateModel->create($params);

        return true;
    }

    public function getFormatedClimateData()
    {
        $climate = new Climate();
        $data = $climate->select(['name', 'temp', 'humidity'])->get()->toArray();
        return response()->json(['data' => $data], 200);
    }
}
