<?php

namespace App\Http\Controllers;

class FCMJobController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * Index page
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        return view('index', []);
    }
}
