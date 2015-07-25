<?php namespace HMIF\Handlers\Commands;

use HMIF\Commands\SendEmailCommand;
use HMIF\Libraries\AttachmentGenerator;
use HMIF\Modules\Email\Entities\EmailAttachmentable;
use Illuminate\Mail\Mailer;
use File;

class SendEmailCommandHandler {

    private $mailer;
    private $attachmentGenerator;

    /**
     * Create the command handler.
     *
     * @param Mailer $mailer
     * @param AttachmentGenerator $attachmentGenerator
     */
    public function __construct(Mailer $mailer, AttachmentGenerator $attachmentGenerator)
    {
        $this->mailer = $mailer;
        $this->attachmentGenerator = $attachmentGenerator;
    }

    /**
     * Handle the command.
     *
     * @param SendEmailCommand $command
     */
    public function handle(SendEmailCommand $command)
    {
        $handler = function ($message) use ($command)
        {
            $message->from($command->from['address'], $command->from['name']);
            $message->to($command->to['address'], $command->to['name']);
            $message->subject($command->subject);
            $message->replyTo('humas@hmifunikom.org', 'Humas HMIF Unikom');

            foreach ($command->attachment as $attachment)
            {
                if($attachment instanceof EmailAttachmentable)
                {
                    $this->generateAttachment($attachment);
                    $attachment = $attachment->getAttachmentFullPath();
                }

                $message->attach($attachment);
            }

            foreach ($command->header as $header)
            {
                $message->getHeaders()->addTextHeader($header['key'], $header['value']);
            }
        };

        $this->mailer->send($command->template, $command->data, $handler);

        foreach($command->attachment as $attachment)
        {
            if($attachment instanceof EmailAttachmentable)
            {
                $attachment = $attachment->getAttachmentFullPath();
            }

            File::delete($attachment);
        }
    }

    private function generateAttachment($attachment)
    {
        $this->attachmentGenerator->setEntity($attachment);
        $this->attachmentGenerator->generate();
    }


}
