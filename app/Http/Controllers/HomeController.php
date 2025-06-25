<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Redirect route based on the user's role
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $role = $user->roles;

        switch ($role[0]->name) {
            case 'admin':;break;
            // if the user is the shop owner, it will redirect to shop.index route
            case 'shop_owner': return redirect()->route('shop.index');
            case 'customer':;break;
            default:break; // guest user
        }
        return view('home');
    }
}
