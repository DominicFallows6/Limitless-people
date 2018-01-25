<?php

namespace Powhr\Controllers\Admin;
use Illuminate\Http\Request;

class BaseAdminController extends \Powhr\Controllers\AuthenticatedController
{
    function __construct(\Illuminate\Http\Request $request, \Powhr\Contracts\PublicAssetsInterface $publicAssets) {

        parent::__construct($request, $publicAssets);

        //todo add middleware check
        $isAdmin = $request->session()->get('is_admin', '0');

        if ($isAdmin < 1) {
            die('no access');
        }

    }
}