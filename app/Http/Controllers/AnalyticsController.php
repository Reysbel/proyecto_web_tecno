<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;

class AnalyticsController extends Controller
{
    public function index()
    {
        $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        return view('admin.analytics', compact('analyticsData'));
    }
}
