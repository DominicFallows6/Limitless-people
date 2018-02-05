<?php

namespace Powhr\Modules\RoomBooking;
use Powhr\Contracts\ModuleInterface;

class Module extends \Powhr\Modules\Module
{

    const MODULE_ID = 9;

    public function setConfig(){
        $this->config['base_path'] = realpath(dirname(__FILE__));
    }
    
}