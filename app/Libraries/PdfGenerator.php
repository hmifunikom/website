<?php namespace HMIF\Libraries;

use HMIF\Modules\Email\Entities\EmailAttachmentable;
use mikehaertl\wkhtmlto\Pdf;

class PdfGenerator {

    protected $pdf;
    protected $entity;
    protected $template;
    protected $isRendered = false;

    public function __construct()
    {
        $this->pdf = new Pdf;
        $this->pdf->binary = env('WKHTMLTOPDF_PATH');
    }

    public function setEntity($entity)
    {
        $this->entity = $entity;

        return $this;
    }

    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    public function save($filename = null)
    {
        $this->render($this->entity);

        if ($this->entity instanceof EmailAttachmentable && $filename == null)
        {
            $filename = $this->entity->getAttachmentFullPath();
        }
        else if ($filename == null)
        {
            $filename = storage_file_path('pdf/' . str_random());
        }

        $this->pdf->saveAs($filename);

        return $filename;
    }

    public function download($filename = 'document.pdf')
    {
        $this->render($this->entity);

        return $this->pdf->send($filename);
    }

    public function stream()
    {
        $this->render($this->entity);

        return response($this->pdf->toString(), 200, ['Content-Type' => 'application/pdf']) ;
    }

    public function output()
    {
        $this->render($this->entity);

        return $this->pdf->toString();
    }

    protected function render($entity)
    {
        if($this->isRendered) return;

        $this->pdf->addPage(view($this->template)->with(compact('entity'))->render());
        $this->isRendered = true;
    }

}
