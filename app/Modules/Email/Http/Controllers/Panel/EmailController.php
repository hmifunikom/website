<?php namespace HMIF\Modules\Email\Http\Controllers\Panel;

use HMIF\Commands\SendEmailCommand;
use HMIF\Modules\Email\Http\Requests\StoreEmailPostRequest;
use HMIF\Modules\Email\Repositories\AttachmentRepository;
use HMIF\Modules\Email\Repositories\Criterias\TypeCriteria;
use HMIF\Modules\Email\Repositories\Criterias\UnreadedCriteria;
use HMIF\Modules\Email\Repositories\EmailRepository;
use HMIF\Modules\Panel\Http\Controllers\PanelController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Input;
use Redirect;
use Hashids;
use Date;


class EmailController extends PanelController {

    private $emailRepository;
    private $attachmentRepository;

    public function __construct(EmailRepository $emailRepository, AttachmentRepository $attachmentRepository)
    {
        $this->emailRepository = $emailRepository;
        $this->attachmentRepository = $attachmentRepository;
    }
	
	public function index()
	{
        if(! Input::has('type'))
        {
            return Redirect::route('panel.email.index', ['type' => 'in'], 301);
        }

        $this->emailRepository->pushCriteria(new TypeCriteria(Input::get('type', 'in')));

        if(Input::has('unreaded'))
        {
            $this->emailRepository->pushCriteria(new UnreadedCriteria());
        }

		$emails = $this->emailRepository->orderBy('date', 'desc')->paginate();

        head_title('Email');
		return view('email::panel.index')->with(compact('emails'));
	}

    public function create()
    {
        $message = $this->getMessageReply();

        head_title('Tulis pesan');
        return view('email::panel.create')->with(compact('message'));
    }

    public function store(StoreEmailPostRequest $request)
    {
        $messageReplyId = $this->getMessageIdReply();

        $data = array_merge($request->all(), $messageReplyId);
        $data['date'] = Date::now();
        $data['type'] = 'out';
        $data['readed'] = 1;

        $email = $this->emailRepository->create($data);

        $data = [
            'subject' => $email->subject,
            'html' => $email->html
        ];
        $data = (object) $data;

        $sendEmail = new SendEmailCommand;
        $sendEmail->setTemplate(['html' => 'email::emails.compose', 'text' => 'email::emails.text.compose'])
            ->setSubject($email->subject)
            ->setData(compact('data'))
            ->setTo($email->email_to)
            ->setFrom('humas@hmifunikom.org', 'Humas HMIF Unikom');

        if(count($messageReplyId))
        {
            $sendEmail->addHeader('In-Reply-To', $messageReplyId['header']['message-id']);
            $sendEmail->addHeader('References', $messageReplyId['header']['message-id']);
        }

        $sendEmail->addHeader('x-hmif-idout', $email->id_email);
        $this->dispatch($sendEmail);

        flash_success_store('Email dikirim.');

        if ($request->ajax())
        {
            return redirect_ajax_notification('panel.email.index', ['type' => 'in']);
        }
        else
        {
            return redirect_ajax('panel.email.index', ['type' => 'in']);
        }
    }

    private function getMessageReply()
    {
        if(! Input::has('reply')) return [];

        $hash = Hashids::connection('email')->decode(Input::get('reply'));
        if (! isset($hash[0])) return [];

        $id = $hash[0];

        try
        {
            $reference = $this->emailRepository->find($id);
        }
        catch(ModelNotFoundException $e)
        {
            return [];
        }

        return $reference;
    }

    private function getMessageIdReply()
    {
        $reference = $this->getMessageReply();

        if(! isset($reference->header['message-id'])) return [];

        return ['header' => ['message-id' => $reference->header['message-id']]];
    }

    public function show($email)
    {
        if(!($email->readed) && $email->type == 'in')
        {
            $email->readed = true;
            $email->save();
        }

        $email->load('attachment');
        head_title($email->subject);
        return view('email::panel.show')->with(compact('email'));
    }

    public function downloadAttachment($email, $attachment)
    {
        $filepath = 'app/mail/' . $attachment->filepath;
        return response()->download(storage_path($filepath), $attachment->filename);
    }

    public function destroy($emailId)
    {
        $email = $this->emailRepository->find($emailId);
        $type = $email->type;
        $email->delete();

        flash_success('Pesan sukses dihapus.');

        return redirect_ajax('panel.email.index', ['type' => $type]);
    }

    public function actionDestroy()
    {
        $ids = Input::get('ids');
        $ids = explode(',', $ids);

        foreach($ids as $id)
        {
            $this->emailRepository->delete($id);
        }

        flash_success('Pesan sukses dihapus.');
        return redirect_ajax_notification('panel.email.index', ['type' => Input::get('type')]);
    }
	
}