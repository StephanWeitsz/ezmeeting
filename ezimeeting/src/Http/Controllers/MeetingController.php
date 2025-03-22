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

    public function delegates($corpId, $meetingId) {
        if (is_null($meetingId) || is_null($corpId)) {
            dd("Required session variables are missing.");
            //return redirect()->route('errorPage')->with('error', 'Required session variables are missing.');
        }
        return view('ezimeeting::meeting.delegates', compact('meetingId', 'corpId'));
    }
}