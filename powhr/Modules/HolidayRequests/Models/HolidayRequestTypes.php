<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 22/10/2016
 * Time: 17:44
 */

namespace powhr\Modules\HolidayRequests\Models;
use Illuminate\Database\Eloquent\Model;


class HolidayRequestTypes extends Model
{

    protected $table = 'holiday_request_types';

    function getRequestsTypes()
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = $this->select();
        return $query->get();
    }

    public function getRequestsTypesAsOptopns()
    {
        
    }

}