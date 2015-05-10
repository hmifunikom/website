<?php namespace HMIF\Modules\Event\Http\Requests;

use HMIF\Modules\Event\Entities\Ticket;

class StoreAttendeePostRequest extends Request {

    public $rules = [
        'nama_peserta' => 'required',
        'alamat'       => 'required',
        'no_hp'        => 'required|numeric',
        'email'        => 'required|email',
        'tiket'        => 'required',
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
        $ticketId = $this->request->get('tiket');
        $ticket = Ticket::find($ticketId);

        if ($ticket)
        {
            $needKtm = $ticket->pluck('ktm');

            if ($needKtm)
            {
                $this->rules['nim'] = 'required|numeric|nim|unique_with:tb_acara_peserta,tiket = id_tiket';
            }

            if ($this->isUpdate())
            {
                if ($needKtm)
                {
                    $attendeeId = hashids_model_decode('event.ticket.peserta', $this->route('attendee'));
                    $this->rules['nim'] .= ',' . $attendeeId;
                }
            }
        }
        else
        {
            if ($this->isUpdate())
            {
                //
            }
        }

        return $this->rules;
    }

}
