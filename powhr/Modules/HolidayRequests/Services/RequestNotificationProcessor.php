<?php

namespace Powhr\Modules\HolidayRequests\Services;
use Powhr\Contracts\Notifier;
use Powhr\Models\User;
use Powhr\Modules\HolidayRequests\Interfaces\HolidayRequestsGroupsRepositoryInterface;

class RequestNotificationProcessor
{

    /**
     * @var Notifier
     */
    private $notifier;
    /**
     * @var HolidayRequestsGroupsRepositoryInterface
     */
    private $holidayRequestGroup;
    /**
     * @var User
     */
    private $user;

    public function __construct(Notifier $notifier, HolidayRequestsGroupsRepositoryInterface $holidayRequestGroup, User $user)
    {
        $this->notifier = $notifier;
        $this->holidayRequestGroup = $holidayRequestGroup;
        $this->user = $user;
    }

    public function sendRequestNotification($id)
    {

        $holidayRequestGroup = $this->holidayRequestGroup->getRequest($id);
        $userSuperior = $this->user->getUserSuperior($holidayRequestGroup->user_id);

        if ($holidayRequestGroup->needs_approval) {
            $this->notifier->setView('emails.holidayRequest');
        } else {
            $this->notifier->setView('emails.attendanceRequestNotification');
        }

        $this->notifier->setBodyData(['hr_model' => $holidayRequestGroup, 'superior'=>$userSuperior]);
        $this->notifier->setRecipients($userSuperior->email, $userSuperior->first_name . ' ' . $userSuperior->surname);
        $this->notifier->setSenderEmail(\Config::get("mail.username"), $holidayRequestGroup->first_name.' '.$holidayRequestGroup->surname);

        $this->notifier->setSubject('Holiday Request For ' . $holidayRequestGroup->first_name.' '.$holidayRequestGroup->surname);
        $this->notifier->send();
    }

    public function sendResponseNotification ($id)
    {

        $holidayRequestGroup = $this->holidayRequestGroup->getRequest($id);
        $userSuperior = $this->user->getUserSuperior($holidayRequestGroup->user_id);

        $this->notifier->setView('emails.holidayRequestResponse');
        $this->notifier->setBodyData(['hr_model' => $holidayRequestGroup]);
        $this->notifier->setRecipients($holidayRequestGroup->email, $holidayRequestGroup->first_name.' '.$holidayRequestGroup->surname);
        $this->notifier->setSenderEmail(\Config::get("mail.username"), $userSuperior->first_name.' '.$userSuperior->surname);

        $this->notifier->setSubject('Your Holiday Request!');
        $this->notifier->send();

    }

}