<?php namespace HMIF\Modules\Panel\Http\Controllers;

use Date;
use LaravelAnalytics;
use Illuminate\Routing\Controller;

class DashboardController extends Controller {

	public function index()
	{
        head_title('Dashboard');
        $analyticsData = LaravelAnalytics::getVisitorsAndPageViews(14);
        $visitors = LaravelAnalytics::performQuery(Date::now()->subDay(14), Date::now(), 'ga:sessions', ['dimensions' => 'ga:userType']);
		return view('panel::dashboard' )->with(['analyticsData' => $analyticsData, 'visitors' => $visitors]);
	}
	
}