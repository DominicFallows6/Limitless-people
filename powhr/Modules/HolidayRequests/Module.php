<?php

namespace Powhr\Modules\HolidayRequests;
use Powhr\Contracts\ModuleInterface;

class Module extends \Powhr\Modules\Module implements ModuleInterface
{
        
    const MODULE_ID = 2;
    const AWAITING_AUTH = -2;

    public function setConfig()
    {
        $this->config['base_path'] = realpath(dirname(__FILE__));
    }

}