<?php namespace HMIF\Http\Controllers\Auth;

use HMIF\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers {
        getLogin as getLoginTrait;
        getRegister as getRegisterTrait;
        postLogin as postLoginTrait;
    }

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

    public function getLogin()
    {
        head_norobot();
        head_title('Masuk');
        return $this->getLoginTrait();
    }


    protected function getFailedLoginMessage()
    {
        return 'Email atau password tidak salah.';
    }

    public function postLogin(Request $request)
    {
        // Bug recaptcha can't use Binput
        $loader = AliasLoader::getInstance();
        $loader->alias('Input', 'Illuminate\Support\Facades\Input');

        $this->validate($request, [
            'g-recaptcha-response' => 'required|recaptcha',
        ]);

        // Switch back to Binput
        $loader->alias('Input', 'GrahamCampbell\Binput\Facades\Binput');

        return $this->postLoginTrait($request);
    }

    public function redirectPath()
    {
        return redirect()->route('panel.index')->getTargetUrl();
    }

}
