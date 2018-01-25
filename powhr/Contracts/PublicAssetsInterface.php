<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 27/07/2016
 * Time: 11:21
 */

namespace Powhr\Contracts;

interface PublicAssetsInterface
{
    function getAssets($businessID);

    function getAssetsByType($type, $businessID);

}