<?php

namespace Powhr\Modules\BusinessAnnouncements\Models;

class BusinessAnnouncementsRss implements InterfaceBusinessAnnouncements {

    function getAllAnnouncements($args = [])
    {

        $announcements = array();

        $announcementsArticle = new \stdClass();
        $announcementsArticle->announcements_title = 'This is post one from RSS';
        $announcementsArticle->announcements_content = 'This is post one content from RSS';
        $announcementsArticle->created_at = '2016-05-04 20:00:00';
        $announcements[] = $announcementsArticle;

        $announcementsArticle = new \stdClass();
        $announcementsArticle->announcements_title = 'This is post two from RSS';
        $announcementsArticle->announcements_content = 'This is post two content from RSS';
        $announcementsArticle->created_at = '2016-03-01 20:00:00';
        $announcements[] = $announcementsArticle;

        return $announcements;

    }

}