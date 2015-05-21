<?php namespace HMIF\Modules\Keanggotaan\Http\Requests;

class StoreAnggotaPostRequest extends Request {

    public $rules = [
        'nim'         => 'required',
        'nama'        => 'required',
        'alamat'      => 'required',
        'asal'        => 'required',
        'status_hima' => '',
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
