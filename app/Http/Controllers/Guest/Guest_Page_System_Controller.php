<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Page_System;
use Illuminate\Http\Request;

class Guest_Page_System_Controller extends Controller
{
    public function show($id){
        $page_system = Page_System::find($id);
        // return $page_system;
        $sent =[
            'page_system' => $page_system
        ];

        return view('guest.page_system.index', $sent);

    }
}
