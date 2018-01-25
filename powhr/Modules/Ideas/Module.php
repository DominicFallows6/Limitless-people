<?php

namespace Powhr\Modules\Ideas;
use Powhr\Contracts\ModuleInterface;

class Module extends \Powhr\Modules\Module
{

    const MODULE_ID = 3;

    public function setConfig(){
        $this->config['base_path'] = realpath(dirname(__FILE__));
    }
    
}