<?php

namespace Powhr\ServiceProviders;
use Illuminate\Support\ServiceProvider;

class SupplementProvider extends ServiceProvider {
    
    function register()
    {

        //subscription interface
        $this->app->bind('\Powhr\Contracts\SubscriptionInterface', '\Powhr\Models\SubscriptionEloquent');

        //this maps any notifications to the mail notiifcation service
        $this->app->bind('Powhr\Contracts\Notifier', '\Powhr\Services\Mail\MailNotifier');

    }

}