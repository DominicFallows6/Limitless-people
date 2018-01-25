<?php

/**
 * I want this to extend this off another class rather the base controller - after invetsigation
 * vendor/laravel/framework/src/Illuminate/Foundation/Http/Kernel.php
 */
namespace Powhr\Modules;

abstract class Module extends \Powhr\Controllers\AuthenticatedController
{

    //can be overriden by a module
    public $viewDirectoryName = 'Views';

    //this will possibly be used for modules customers are subscribed to
    protected $subscribedModules = array();
    protected $config;

    /**
     * Method that sets config per module
     * @return mixed
     */
    abstract function setConfig(); 

    function __construct(\Illuminate\Http\Request $request, \Powhr\Contracts\PublicAssetsInterface $publicAssets)
    {

        parent::__construct($request, $publicAssets);

        //initialise with blank array for config
        $this->config = new \Illuminate\Support\Collection(array());

        //remember is set by child class
        $this->setConfig();
        $this->setViewPath();
    }

    /**
     * Public accessor for module config
     * @param bool $keyName
     * @return \Illuminate\Support\Collection|mixed
     */
    public function getConfig($keyName = false)
    {
        if ($keyName) {
            return $this->config[$keyName];
        } else {
            return $this->config;
        }
    }

    /**
     * Sets path for views in Modules
     */
    public function setViewPath()
    {
        $this->config['view_path'] = $this->config['base_path'].'/'.$this->viewDirectoryName;
        \View::addLocation($this->config['view_path']);
    }

}