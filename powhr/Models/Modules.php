<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 03/09/2016
 * Time: 19:18
 */

namespace Powhr\Models;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $table = 'Modules';
    
    function getModuleList($args = array())
    {

        /** @var \Illuminate\Database\Query\Builder $query */
        $query = $this->select(['*']);

        if (!empty($args['exclude'])) {
            $query->whereNotIn('id', $args['exclude']);
        }

        if (!empty($args['single'])) {
            return $query->first();
        } else {
            return $query->get();
        }

    }
    
}