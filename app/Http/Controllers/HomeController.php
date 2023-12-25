<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Terms for user from application.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        return view('terms');
    }
}
