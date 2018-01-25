<?php


namespace Powhr\Models;
use Illuminate\Database\Eloquent\Model;

class SubscriptionEloquent extends Model implements \Powhr\Contracts\SubscriptionInterface
{

    //protected $table = 'organisation_units';

    function getSubscribedModules()
    {
        return array (
            'BusinessAnnouncements',
            'Flexi',
            'HolidayRequests',
            'Ideas'
        );
    }

}