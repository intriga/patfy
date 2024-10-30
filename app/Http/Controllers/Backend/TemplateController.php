<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Userlog;
use App\Http\Controllers\Backend\LogUserController;

use Carbon\Carbon;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userlog = Userlog::get();
        // dd($userlog);
        return view('backend.template.dashboard', compact('userlog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

        // Current time in your default timezone
        $now = Carbon::now();

        // Convert to the desired timezone before saving
        $nowInNewTimezone = $now->setTimezone('America/Caracas');        
               
        $getIpAddress = LogUserController::getUserIpAddr();
        $checkOS = LogUserController::getOS();
        $checkBrowser = LogUserController::getBrowser();
        $checkLocationUser = LogUserController::getLocationUser();
        // $coordinateUser = LogUserController::getCoordinatesUser();

        //dd($getIpAddress, $checkOS, $checkBrowser, $checkLocationUser);

        UserLog::create([
            'ip' => $getIpAddress,
            'os' => $checkOS,
            'browser' => $checkBrowser,
            'country' => $checkLocationUser['country'],
            'city' => $checkLocationUser['city'],
            'isp' => $checkLocationUser['isp'],
            'created_at' => $nowInNewTimezone,
        ]);
        //dd($nowInNewTimezone);
        // how to send this data to database
        
        return view('backend.template.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
