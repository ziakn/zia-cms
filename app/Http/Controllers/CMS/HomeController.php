<?php
namespace App\Http\Controllers\CMS;
use App\Http\Controllers\Controller;

use App\Models\Home;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    
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
        // dd('hi');
        // if($user->type==1 && $user->status==1)
        // {
            return view('dashboard');
        // }
        // else
        // {
        //     return view('restriction');
        // }
    }
}
