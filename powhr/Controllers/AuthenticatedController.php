<?php

namespace Powhr\Controllers;

class AuthenticatedController extends BaseController
{

    public $si;
    public $userBusinessID;
    public $userID;
    protected $request;

    function __construct(\Illuminate\Http\Request $request, \Powhr\Contracts\PublicAssetsInterface $publicAssets) {

        //$this->createDependencies();

        //store data for further requests
        $this->request = $request;
        $this->userBusinessID = $this->request->user()->organisationUnit->business_id;
        $this->userID = $request->user()->id;

        //add public assets to views
        $assets = $publicAssets->getAssets($this->userBusinessID);
        \View::share('business_assets', $assets);

    }
    
}