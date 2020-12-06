<?php

namespace App\Http\Controllers;

use App\Models\User;

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
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /** @var User $data */
        $user = auth()->user();
        $data = $user['id'];
        //$data = 'dsf';

        return view('task')->with('data', json_encode($data));
    }
}
