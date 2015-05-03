<?php namespace HMIF\Modules\User\Http\Controllers\Panel;

use HMIF\Modules\User\Repositories\UserRepository;
use Illuminate\Routing\Controller;

class UserController extends Controller {

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