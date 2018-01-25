<?php

namespace Powhr\ServiceProviders;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Powhr\Models\Business;
use Powhr\Models\Modules;
use Powhr\Models\ModulesBusiness;
use Powhr\Models\UserRoles;
use Powhr\Models\UsersUserRoles;

class PolicyProvider extends ServiceProvider
{

    public function boot(GateContract $gate, UsersUserRoles $userRoles, ModulesBusiness $modulesBusiness)
    {

        /**
         * Check access to particular role against user and module
         * Roles are listed in database
         */
        $gate->define('access_action', function($user, $roleID, $moduleID) use ($userRoles, $modulesBusiness) {

            $checkUser = $userRoles->checkRoleForUser($user->id, $roleID);
            $checkModule = $modulesBusiness->checkSpecificSubscription($user->organisationUnit->business_id, $moduleID);

            if ($checkUser && $checkModule) {
                return true;
            } else {
                return false;
            }

        });

        /**
         * Check to see if a module has been subscribed to
         */
        $gate->define('access_module', function($user, $moduleID) use ($modulesBusiness) {
        
            $checkModule = $modulesBusiness->checkSpecificSubscription($user->organisationUnit->business_id, $moduleID);

            if ($checkModule) {
                return true;
            } else {
                return false;
            }

        });

    }

}
