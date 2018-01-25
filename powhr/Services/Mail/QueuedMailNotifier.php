<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 03/07/2016
 * Time: 16:54
 */

namespace Powhr\Services\Mail;
use Powhr\Contracts\Notifier;

class QueuedMailNotifier extends MailAbstract implements Notifier
{

    public function send()
    {

        //need to create a variable for closure
        $messageData = $this->messageData;

        //send to superior
        \Mail::queueOn($this->messageData['view_path'], ['bodyData' => $this->messageData['body_data']], function ($m) use ($messageData) {
            $m->from($messageData['sender'], $messageData['sender_name']);
            $m->to($messageData['recipients'], $messageData['recipient_name']);
            $m->bcc($messageData['bcc'], $messageData['bcc_name']);
            $m->subject($messageData['subject']);
        });
        
    }

}