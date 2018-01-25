<?php

namespace Powhr\Services\Mail;
use Powhr\Contracts\Notifier;

class MailAbstract
{

    protected $messageData = [];

    public function setBodyData($bodyData) {
        $this->messageData['body_data'] = $bodyData;
    }

    public function setView( $viewFilePath)
    {
        $this->messageData['view_path'] = $viewFilePath;
    }

    public function setRecipients($recipients,  $name = null)
    {
        $this->messageData['recipients'] = $recipients;
        $this->messageData['recipient_name'] = $name;
    }

    public function setSubject( $subject)
    {
        $this->messageData['subject'] = $subject;
    }

    public function setPublicListedCopiedUsers($recipients,  $name = null)
    {
        $this->messageData['cc'] = $recipients;
        $this->messageData['cc_name'] = $name;
    }

    public function setPrivateListedCopiedUsers($recipients,  $name = null)
    {
        $this->messageData['bcc'] = $recipients;
        $this->messageData['bcc_name'] = $name;
    }

    public function setSenderEmail( $from,  $name = null)
    {
        $this->messageData['sender'] = $from;
        $this->messageData['sender_name'] = $name;
    }
    
}