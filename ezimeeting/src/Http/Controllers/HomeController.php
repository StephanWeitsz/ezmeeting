<?php

namespace Mudtec\Ezimeeting\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\View\View;

use Mudtec\Ezimeeting\Models\User;

class HomeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        Log::info("eziMeeting Landing Page");

        if(auth()->check()) {
            $user = User::find(Auth::id());
            if ($user && !$user->corporations()->exists()) {
                Log::info("Redirect to Corporate Registration");
                return view('ezimeeting::admin.corporations.corporationRegister');
            }
        }
	    Log::info("Navigate to eziMeeting Home");
        $meetings = [];
        if (auth()->check()) {
            $user = User::find(Auth::id());
            //$meetings = $user->corporations()->with('departments.meetings')->get()->pluck('departments')->flatten()->pluck('meetings')->flatten();

            $meetings = $user->corporations()
                ->with(['departments.meetings' => function($query) {
                    $query->orderBy('scheduled_at', 'desc');
                }])
                ->get()
                ->pluck('departments')
                ->flatten()
                ->pluck('meetings')
                ->flatten()
                ->take(5);

            Log::info("User has access to " . count($meetings) . " meetings");
        }
        return view('ezimeeting::home', compact('meetings'));
    }
}

