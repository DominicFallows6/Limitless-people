<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 03/09/2016
 * Time: 19:18
 */

namespace Powhr\Models;

use Illuminate\Database\Eloquent\Model;

class UsersUserRoles extends Model
{
    protected $table = 'users_user_roles';

    public function checkRoleForUser($userID, $userRoleID)
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = $this->select(['*']);
        $query->where('user_id', $userID);
        $query->where('user_role_id', $userRoleID);
        $result = $query->get();

        if (!$result->isEmpty()) {
            return true;
        } else {
            return false;
        }
        
    }

}