<?php namespace HMIF\Modules\Keanggotaan\Http\Requests;

class StoreAnggotaPostRequest extends Request {

    public $rules = [
        'jenis_kelamin' => 'required',
        'tempat_lahir'  => '',
        'tanggal_lahir' => 'date',
        'alamat'        => '',
        'agama'         => '',
        'no_hp'         => '',
        'email'         => '',
        'facebook'      => '',
        'twitter'       => '',
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
            //
        }

        return $this->rules;
    }

}
