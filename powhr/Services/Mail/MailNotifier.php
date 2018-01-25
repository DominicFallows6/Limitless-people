<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 03/07/2016
 * Time: 16:54
 */

namespace Powhr\Services\Mail;
use Powhr\Contracts\Notifier;

class MailNotifier extends MailAbstract implements Notifier
{

    public function send()
    {

        //need to create a variable for closure
        $messageData = $this->messageData;

        //send to superior
        \Mail::send($this->messageData['view_path'], ['bodyData' => $this->messageData['body_data']], function ($m) use ($messageData) {
            $m->from($messageData['sender'], $messageData['sender_name']);
            $m->to($messageData['recipients'], $messageData['recipient_name']);

            if(!empty($messageData['bcc'])) {
                $m->bcc($messageData['bcc'], $messageData['bcc_name']);
            }

            $m->subject($messageData['subject']);
        });
        
    }

}