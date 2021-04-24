<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Cuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *  
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (false == Auth::check()) {
            return redirect('/login')->with(
                'error',
                'Access denied: please login to continue'
            );
        } else {
            //$id = auth()->user()->id;
            $users = Cuser::all();
            // return $user;
            return view('dashboard')->with('users', $users);
        }
    }
}
