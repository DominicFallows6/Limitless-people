<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 10/07/2016
 * Time: 18:32
 */

namespace Powhr\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Base Class powhrEloquentModel for Eloquent Models
 * @package Powhr\Models
 */
class PowhrEloquentModel extends Model
{

    /**
     * Unified method for interfaced version of eloquent models
     * @param $id
     */
    function getItem($id, $key = 'id')
    {
        return $this->find($id);
    }
    
    function getAll(array $args = [])
    {
        
    }

}