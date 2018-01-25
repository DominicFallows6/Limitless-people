<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 03/09/2016
 * Time: 19:18
 */

namespace Powhr\Models;

class ModulesBusiness extends \Powhr\Models\PowhrEloquentModel
{
    protected $table = 'modules_business AS mb';

    /**
     * Returns all modules subscribed to by a business
     * @param $args
     * @return mixed
     */
    public function getBusinessSubscriptions($args)
    {
        $query = $this->join('business AS b', 'business_id', '=', 'b.id');
        $query->join('modules AS m', 'module_id', '=', 'm.id');

        if (!empty($args['business_id'])) {
            $query->where('business_id', $args['business_id']);
        }

        return ($query->get(['*']));

    }

    /**
     * Gets a list of subscribed modules in a one dimensional array
     * @param $args
     * @return array
     */
    public function getFlatBusinessSubscriptions($args)
    {
        $subscribedModules = $this->getBusinessSubscriptions($args);
        return createOneDimension('id', $subscribedModules);
    }

    function checkSpecificSubscription($businessID, $moduleID)
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = $this->select(['*']);
        $query->where('business_id', $businessID);
        $query->where('module_id', $moduleID);
        $result = $query->get();

        if (!$result->isEmpty()) {
            return true;
        } else {
            return false;
        }
    }

}