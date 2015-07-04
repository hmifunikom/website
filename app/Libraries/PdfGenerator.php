<?php namespace HMIF\Libraries;

use Barryvdh\DomPDF\PDF;
use HMIF\Modules\Email\Entities\EmailAttachmentable;

class PdfGenerator {

    protected $pdf;
    protected $entity;
    protected $template;

    protected $isRendered = false;

    public function __construct()
    {
        $this->pdf = app('dompdf.wrapper');

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
            $filename = storage_path('pdf/' . str_random());
        }

        $this->pdf->save($filename);

        return $filename;
    }

    public function download($filename = 'document.pdf')
    {
        $this->render($this->entity);

        return $this->pdf->download($filename);
    }

    public function stream($filename = 'document.pdf')
    {
        $this->render($this->entity);

        return $this->pdf->stream($filename);
    }

    public function output()
    {
        $this->render($this->entity);

        return $this->pdf->output();
    }

    protected function render($entity)
    {
        if($this->isRendered) return;

        $this->pdf->loadHTML(view($this->template)->with(compact('entity'))->render());
        $this->isRendered = true;
    }

}
