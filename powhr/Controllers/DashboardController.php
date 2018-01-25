<?php

namespace Powhr\Controllers;

class DashboardController extends AuthenticatedController
{

    protected $ba;
    
    function getIndex(\Powhr\Modules\BusinessAnnouncements\Models\InterfaceBusinessAnnouncements $ba)
    {
        $this->ba = $ba;
        $data['announcements'] = $this->ba->getAllAnnouncements(['business_id' => $this->userBusinessID]);
        return \View::make('general.dashboardHome')->with('data', $data);
    }

}