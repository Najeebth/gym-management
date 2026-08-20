<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('admin.dashboard', [
            'totalClients' => Client::count(),
            'activeClients' => Client::active()->count(),
            'newThisMonth' => Client::whereMonth('join_date', now()->month)
                ->whereYear('join_date', now()->year)
                ->count(),
        ]);
    }
}
