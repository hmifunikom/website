<?php namespace HMIF\Modules\Event\Http\Requests;

class StoreEventPostRequest extends Request {

    public $rules = [
        'nama_acara'    => 'required',
        'mulai_tanggal' => 'required|date',
        'mulai_waktu'   => 'required',
        'tempat'        => 'required|max:30',
        'info'          => 'required',
        'pj'            => 'required',
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
