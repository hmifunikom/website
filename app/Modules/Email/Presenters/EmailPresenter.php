<?php namespace HMIF\Modules\Email\Presenters;

use Date;
use HMIF\Modules\Email\Entities\Email;
use McCool\LaravelAutoPresenter\BasePresenter;

class EmailPresenter extends BasePresenter {

    public function __construct(Email $resource)
    {
        $this->wrappedObject = $resource;
    }

    public function dateDiff()
    {
        return $this->wrappedObject->date->diffForHumans();
    }

    public function dateFull()
    {
        return $this->wrappedObject->date->format('l, j F Y @ H:i');
    }

    public function fromName()
    {
        $parse = mailparse_rfc822_parse_addresses($this->wrappedObject->email_from);
        return $parse[0]['display'];
    }

    public function fromEmail()
    {
        $parse = mailparse_rfc822_parse_addresses($this->wrappedObject->email_from);
        return $parse[0]['address'];
    }

    public function toName()
    {
        $parse = mailparse_rfc822_parse_addresses($this->wrappedObject->email_to);
        return $parse[0]['display'];
    }

    public function toEmail()
    {
        $parse = mailparse_rfc822_parse_addresses($this->wrappedObject->email_to);
        return $parse[0]['address'];
    }

    public function subjectName()
    {
        if($this->wrappedObject->type == 'in')
        {
            return $this->fromName();
        }
        else
        {
            return $this->toName();
        }
    }

    public function subjectEmail()
    {
        if($this->wrappedObject->type == 'in')
        {
            return $this->fromEmail();
        }
        else
        {
            return $this->toEmail();
        }
    }

    public function shortText()
    {
        return limit_text($this->wrappedObject->text, 20);
    }

    public function sign()
    {
        if($this->wrappedObject->type == 'in')
        {
            if($this->wrappedObject->readed == 0)
            {
                return 'danger';
            }
            else
            {
                return 'primary';
            }
        }
        else
        {
            return 'inverse';
        }
    }

}
