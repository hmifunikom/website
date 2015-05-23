<?php namespace HMIF\Modules\Keanggotaan\Presenters;

use HMIF\Libraries\NimParser;
use HMIF\Modules\Keanggotaan\Entities\Anggota;
use McCool\LaravelAutoPresenter\BasePresenter;

class AnggotaPresenter extends BasePresenter {

    public function __construct(Anggota $resource)
    {
        $this->wrappedObject = $resource;
    }

    public function nim()
    {
        return (new NimParser($this->wrappedObject->nim));
    }

    public function facebook()
    {
        if ($this->wrappedObject->facebook)
        {
            $reg_exUrl = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';


            if ( ! preg_match($reg_exUrl, $this->wrappedObject->facebook, $url))
            {
                return preg_replace(['/^([a-z0-9_]+)/i'],
                                    ['<a href="https://www.facebook.com/$1" target="_blank">$1</a>'],
                                    $this->wrappedObject->facebook);
            }
            else
            {
                return preg_replace(['/^(http|https):\/\/(www\.)?facebook.com\/([a-z0-9_]+)/i'],
                                    ['<a href="https://www.facebook.com/$3" target="_blank">$3</a>'],
                                    $this->wrappedObject->facebook);
            }
        }

        return null;
    }

    public function twitter()
    {
        if ($this->wrappedObject->twitter)
        {
            return preg_replace(['/(^|\s)@([a-z0-9_]+)/i', '/^(http|https):\/\/(www\.)?twitter.com\/([a-z0-9_]+)/i'],
                                ['$1<a href="https://twitter.com/$2" target="_blank">@$2</a>', '<a href="https://twitter.com/$3" target="_blank">@$3</a>'],
                                $this->wrappedObject->twitter);
        }

        return null;
    }

    public function avatar()
    {
        return avatar($this->wrappedObject->avatar);
    }

    public function jabatan()
    {
        if ($this->anggota_spesial())
        {
            if ($this->wrappedObject->divisi->id_divisi > 4)
            {
                return 'Ketua Divisi ' . $this->wrappedObject->divisi->divisi;
            }
            else
            {
                return $this->wrappedObject->divisi->divisi;
            }
        }
        else
        {
            return $this->wrappedObject->divisi->divisi;
        }
    }

    public function anggota_spesial()
    {
        return $this->wrappedObject->divisi->id_penanggung_jawab == $this->wrappedObject->id_anggota;
    }

}
