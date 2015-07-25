<?php namespace HMIF\Modules\Email\Http\Requests;

class StoreEmailPostRequest extends Request {

    public $rules = [
        'email_to' => 'required|email',
        'subject'  => '',
        'html'     => 'required',
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
