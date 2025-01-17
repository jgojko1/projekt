<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request)
    {
        $statistics = [
            'number_of_services' => Service::count(),
            'number_of_users' => User::count(),
            'number_of_devices' => Device::count(),
        ];
        return view('home.dashboard', ['statistics' => $statistics]);
    }

    public function index_cached(Request $request)
    {
        // Cache the statistics for 10 minutes (or adjust as needed)
        $statistics = Cache::remember('dashboard_statistics', now()->addMinutes(5), function () {
            return [
                'number_of_services' => Service::count(),
                'number_of_users' => User::count(),
                'number_of_devices' => Device::count(),
            ];
        });

        return view('home.dashboard', ['statistics' => $statistics]);
    }
}