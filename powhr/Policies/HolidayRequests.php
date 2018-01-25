<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 01/09/2016
 * Time: 07:41
 */

namespace Powhr\Policies;

class HolidayRequests
{
    function checkDownload($user, $contact)
    {
        print_r($contact);
        if ($contact->user_id == $user->id) {
            return true;
        } else {
            return false;
        }
    }
}
