<?php

namespace App\Http\Controllers;

use App\Services\MembershipPlanService;
use App\Services\WebsiteService;

class PageController extends Controller
{
    public function about(WebsiteService $websiteService)
    {
        return view('about', ['about' => $websiteService->getAbout()]);
    }

    public function membershipPlans(MembershipPlanService $membershipPlanService)
    {
        return view('membership-plans', ['plans' => $membershipPlanService->activePlansForPublicDisplay()]);
    }

    public function contact(WebsiteService $websiteService)
    {
        return view('contact', ['contact' => $websiteService->getContact()]);
    }
}
