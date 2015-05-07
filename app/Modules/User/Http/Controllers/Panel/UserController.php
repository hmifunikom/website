<?php namespace HMIF\Modules\User\Http\Controllers\Panel;

use HMIF\Modules\Panel\Http\Controllers\PanelController;
use HMIF\Modules\User\Repositories\UserRepository;

class UserController extends PanelController {

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

	public function index()
	{
        $users = $this->userRepository->paginate();

        $data = compact('users');

        return view('user::panel.index')->with($data);
	}
	
}