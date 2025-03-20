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
        Log::info("Landing Page");

        if(auth()->check()) {
            $user = User::find(Auth::id());
            if ($user && !$user->corporations()->exists()) {
                Log::info("Redirect to Corporate Registration");
                return view('ezimeeting::admin.corporations.corporationRegister');
            }
        }

	    Log::info("Navigate to Dashboard");
        return view('ezimeeting::home');
        
    }
}

