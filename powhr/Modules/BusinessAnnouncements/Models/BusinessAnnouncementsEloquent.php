<?php

namespace Powhr\Modules\BusinessAnnouncements\Models;
use Powhr\Models\powhrEloquentModel;

class BusinessAnnouncementsEloquent extends PowhrEloquentModel implements InterfaceBusinessAnnouncements {

    protected $table = 'business_announcements';

    function getAllAnnouncements($args = [])
    {

        $query = $this->join('business AS b', 'business_id', '=', 'b.id');
        $query->join('users AS u', 'business_announcements.user_id', '=', 'u.id');

        if (is_numeric($args['business_id'])) {
            $query->where('business_id', $args['business_id']);
        }

        return $query->orderBy('business_announcements.id', 'desc')->get(['business_announcements.*', 'u.first_name', 'u.surname']);

    }

}