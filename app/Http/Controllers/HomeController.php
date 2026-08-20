<?php

namespace App\Http\Controllers;

use App\Services\MembershipPlanService;
use App\Services\WebsiteService;

class HomeController extends Controller
{
    public function index(WebsiteService $websiteService, MembershipPlanService $membershipPlanService)
    {
        return view('home', [
            'home' => $websiteService->getHome(),
            'plans' => $membershipPlanService->activePlansForPublicDisplay(),
        ]);
    }
}
