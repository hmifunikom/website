<?php namespace HMIF\Http\Controllers;

use HMIF\Modules\Event\Repositories\Criterias\UpcomingEventCriteria;
use HMIF\Modules\Event\Repositories\EventRepository;
use HMIF\Modules\Keanggotaan\Repositories\AnggotaRepository;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\ActiveCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\ByDivisiCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\OrganigramCriteria;


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
	public function index(AnggotaRepository $anggotaRepository, EventRepository $eventRepository)
	{
        $inti = $anggotaRepository->pushCriteria(new ActiveCriteria())
            ->pushCriteria(new OrganigramCriteria())
            ->pushCriteria(new ByDivisiCriteria('1234'))
            ->all();

		$upcoming = $eventRepository->pushCriteria(new UpcomingEventCriteria(3))->all();
        return view('index')->with(compact('inti', 'upcoming'));
	}

}
