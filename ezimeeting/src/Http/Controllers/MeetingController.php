<?php

namespace Mudtec\Ezimeeting\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\View\View;


class MeetingController extends Controller
{
    public function new() {
        return view('ezimeeting::meeting.new');
    }
}