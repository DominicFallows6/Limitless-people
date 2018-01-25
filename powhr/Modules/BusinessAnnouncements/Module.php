<?php

namespace Powhr\Modules\BusinessAnnouncements;
use Powhr\Contracts\ModuleInterface;

class Module extends \Powhr\Modules\Module
{

    const MODULE_ID = 1;
    
    public function setConfig()
    {
        //set here as a base for the module
        $this->config['base_path'] = realpath(dirname(__FILE__));
    }
    
}