<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\Backend\LogUserController;


class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.template.dashboard');
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
               
        $getIpAddress = LogUserController::getUserIpAddr();
        $checkOS = LogUserController::getOS();
        $checkBrowser = LogUserController::getBrowser();
        $checkLocationUser = LogUserController::getLocationUser();
        // $coordinateUser = LogUserController::getCoordinatesUser();

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
