<?php

namespace Powhr\Modules\StaffDocs;
use Powhr\Contracts\ModuleInterface;

class Module extends \Powhr\Modules\Module
{

    const MODULE_ID = 4;

    public function setConfig(){
        $this->config['base_path'] = realpath(dirname(__FILE__));
    }
    
}