<?php namespace HMIF\Modules\User\Http\Requests;

class StoreUserPostRequest extends Request {

    public $rules = [
        'email'                 => 'required|email|unique:users',
        'password'              => 'required|confirmed|min:8',
        'password_confirmation' => 'required',
        'role'                  => 'required',
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return parent::authorize();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isUpdate())
        {
            $this->rules['email'] .= ',email,' . $this->route('user') . ',id_user';

            if ( ! $this->request->get('password'))
            {
                unset($this->rules['password']);
                unset($this->rules['password_confirmation']);
            }
        }

        return $this->rules;
    }

}
