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

        $climateModel = $climate->select(['id'])->where('name', $params['name'])->get();
        if (!$climateModel->isEmpty()){
            $climateModel[0]->update($params);
            $climateModel[0]->save();
            return true;
        }
        $climate->create($params);

        return true;
    }

    public function getFormatedClimateData()
    {
        $climate = new Climate();
        $data = $climate->select(['name', 'temp', 'humidity'])->get()->toArray();
        return response()->json(['data' => $data], 200);
    }
}
