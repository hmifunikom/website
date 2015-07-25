<?php namespace HMIF\Commands;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use HMIF\Modules\Email\Entities\EmailAttachmentable;

class SendEmailCommand extends Command implements ShouldBeQueued {

    use InteractsWithQueue, SerializesModels;

    public $template;
    public $data = [];
    public $from;
    public $to;
    public $subject;
    public $attachment = [];
    public $header = [];

    public function __construct()
    {
        $this->from = [
            'address' => config('mail.from.address'),
            'name'    => config('mail.from.name'),
        ];
    }

    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function setFrom($address, $name = null)
    {
        $this->from = compact('address', 'name');

        return $this;
    }

    public function setTo($address, $name = null)
    {
        $this->to = compact('address', 'name');

        return $this;
    }

    public function setSubject($subject = '')
    {
        $this->subject = $subject;

        return $this;
    }

    public function addAttachment($attachment)
    {
        $this->attachment[] = $attachment;

        return $this;
    }

    public function addHeader($key, $value)
    {
        $this->header[] = compact('key', 'value');

        return $this;
    }

}
