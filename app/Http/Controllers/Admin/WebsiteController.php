<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('admin.website.index');
    }

    public function home()
    {
        return view('admin.website.home');
    }

    public function about()
    {
        return view('admin.website.about');
    }

    public function contact()
    {
        return view('admin.website.contact');
    }

    public function footer()
    {
        return view('admin.website.footer');
    }

    public function navigation()
    {
        return view('admin.website.navigation');
    }

    public function membershipPlans()
    {
        return view('admin.website.membership-plans');
    }
}
