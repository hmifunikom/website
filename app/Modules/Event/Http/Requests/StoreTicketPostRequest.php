<?php namespace HMIF\Modules\Event\Http\Requests;

class StoreTicketPostRequest extends Request {

    public $rules = [
        'nama_tiket' => 'required',
        'kuota'       => 'required|integer',
        'harga'       => 'required|integer',
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
