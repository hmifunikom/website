<?php namespace HMIF\Http\Controllers;

use HMIF\Modules\Event\Repositories\Criterias\UpcomingEventCriteria;
use HMIF\Modules\Event\Repositories\EventRepository;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

    /**
     * Show the application dashboard to the user.
     *
     * @param EventRepository $eventRepository
     * @return Response
     */
	public function index(EventRepository $eventRepository)
	{
		$upcoming = $eventRepository->pushCriteria(new UpcomingEventCriteria(3))->all();
        return view('index')->with(compact('upcoming'));
	}

}
