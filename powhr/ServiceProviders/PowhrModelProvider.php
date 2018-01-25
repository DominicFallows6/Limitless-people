<?php

namespace Powhr\ServiceProviders;
use Illuminate\Support\ServiceProvider;
use Powhr\Modules\HolidayRequests\Interfaces\HolidayRequestsGroupsRepositoryInterface;
use Powhr\Modules\HolidayRequests\Interfaces\HolidayRequestsRepositoryInterface;
use Powhr\Modules\HolidayRequests\Repositories\HolidayRequestGroups;

class PowhrModelProvider extends ServiceProvider {

    function boot()
    {

    }

    function register()
    {

        $this->app->bind('\Powhr\Modules\BusinessAnnouncements\Models\InterfaceBusinessAnnouncements','\Powhr\Modules\BusinessAnnouncements\Models\BusinessAnnouncementsEloquent');

        //$this->app->bind('\Powhr\Modules\BusinessAnnouncements\Models\InterfaceBusinessAnnouncements','\Powhr\Modules\BusinessAnnouncements\Models\BusinessAnnouncementsRss');

        $this->app->bind('\Powhr\Contracts\PublicAssetsInterface', '\Powhr\Models\PublicAssets');

        $this->app->bind(HolidayRequestsRepositoryInterface::class, \Powhr\Modules\HolidayRequests\Repositories\HolidayRequests::class);

        $this->app->bind(HolidayRequestsGroupsRepositoryInterface::class, HolidayRequestGroups::class);
        
    }

}