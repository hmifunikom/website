<?php namespace HMIF\Modules\User\Http\Controllers\Panel;

use HMIF\Modules\Keanggotaan\Repositories\Criterias\ActiveCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\ByDivisiCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\ByStatusCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\NoUserCriteria;
use HMIF\Modules\Keanggotaan\Repositories\Criterias\OrganigramCriteria;
use HMIF\Modules\Panel\Http\Controllers\PanelController;
use HMIF\Modules\User\Http\Requests\StoreUserPostRequest;
use HMIF\Modules\User\Repositories\UserRepository;
use Input;

class UserController extends PanelController {

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->authorizeResource(['class' => 'HMIF\Modules\User\Entities\User', 'key' => 'user']);
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->paginate();

        $data = compact('users');

        return view('user::panel.index')->with($data);
    }

    public function create($nim = null)
    {
        if ($nim)
        {
            $anggota = app('HMIF\Modules\Keanggotaan\Repositories\AnggotaRepository')->findByField('nim', $nim);

            head_title('Tambah User HMIF');

            return view('user::panel.create')->with(compact('anggota'));
        }
        else
        {
            $anggota = app('HMIF\Modules\Keanggotaan\Repositories\AnggotaRepository')
                ->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'))
                ->pushCriteria(new ActiveCriteria())
                ->pushCriteria(new OrganigramCriteria())
                ->pushCriteria(new ByDivisiCriteria(Input::get('divisi')))
                ->pushCriteria(new ByStatusCriteria(Input::get('status')))
                ->pushCriteria(new NoUserCriteria())
                ->paginate();

            $divisi = app('HMIF\Modules\Keanggotaan\Repositories\DivisiRepository')->all();

            head_title('Daftar anggota HMIF');

            return view('user::panel.createlist')->with(compact('anggota', 'divisi'));
        }
    }

    public function store(StoreUserPostRequest $request)
    {
        $anggota = app('HMIF\Modules\Keanggotaan\Repositories\AnggotaRepository')->findByField('nim', Input::get('nim'));

        $user = $this->userRepository->makeModel();
        $user->email = Input::get('email');
        $user->password = Input::get('password');

        $anggota->user()->save($user);

        $roles = Input::get('role');
        $user->roles()->sync((array) $roles);

        flash_success_store('User sukses ditambah.');

        if ($request->ajax())
        {
            return redirect_ajax_notification('panel.user.index');
        }
        else
        {
            return redirect_ajax('panel.user.index');
        }
    }

    public function edit($user)
    {
        head_title('Edit User HMIF');
        return view('user::panel.edit')->with(compact('user'));
    }

    public function update($userId, StoreUserPostRequest $request)
    {
        $user = $this->userRepository->find($userId);
        $user->email = Input::get('email');

        if(Input::get('password'))
        {
            $user->password = Input::get('password');
        }

        $user->save();

        if(Input::get('role'))
        {
            $roles = Input::get('role');
            $user->roles()->sync((array) $roles);
        }

        flash_success_update('User sukses diubah.');

        if ($request->ajax())
        {
            return redirect_ajax_notification('panel.user.index');
        }
        else
        {
            return redirect_ajax('panel.user.index');
        }
    }

    public function destroy($userId)
    {
        $this->userRepository->delete($userId);

        flash_success('User sukses dihapus.');

        return redirect_ajax('panel.user.index');
    }
}