<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 03/07/2016
 * Time: 16:53
 */

namespace Powhr\Contracts;

interface Notifier
{

    public function setBodyData($bodyData);

    public function setView($viewFilePath);

    public function send();

    public function setRecipients($recipients, $name = null);
    
    public function setSubject( $subject);

    public function setPublicListedCopiedUsers($recipients,  $name = null);

    public function setPrivateListedCopiedUsers($recipients,  $name = null);

    public function setSenderEmail( $from,  $name = null);

}