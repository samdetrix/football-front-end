<?php

namespace App\Http\Controllers;

use App\Models\FootballTeam;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function homePage()
    {
        return view('client.home');
    }
    public function signInPage()
    {
        return view('client.login');
    }
    public function registerPage()
    {
        return view('client.register');
    }
    public function dashboardPage()
    {
        return view('admin.dashboard');
    }
    public function featuredgames()
    {
        return view('admin.featured');
    }

    public function myProfile()
    {
        return view('admin.profile');
    }
    public function changePwd()
    {
        return view('admin.change-pwd');
    }
    public function updateUser()
    {
        return view('admin.update-details');
    }
    public function forgotPwd()
    {
        return view('admin.forgot-pwd');
    }
    public function viewDetails($match_id)
    {
        $match = FootballTeam::find($match_id);
        // dd($match);
        return view('admin.details', compact('match'));
    }
}
