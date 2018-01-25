<?php

namespace Powhr\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends PowhrEloquentModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{

    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * A value from the database that represents an active user
     */
    const ACTIVE_USER_ID = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];
    private $sortDelimter = ',';

    public function organisationUnit()
    {
        return $this->belongsTo('Powhr\Models\OrganisationUnits');
    }

    public function ideas()
    {
        return $this->hasMany('Ideas');
    }

    /**
     * Gets a user's direct superior
     *
     * @return mixed
     */
    public function getUserSuperior($id = false)
    {

        if (!$id) {
            $superiorUser = $this->find($this->superior_id);
        } else {
            $thisUser = $this->find($id);
            $superiorUser = $this->find($thisUser->superior_id);
        }

        return ($superiorUser);

    }

    /**
     * Gets user list with
     *
     * @param array $args
     * @return mixed
     */
    public function getUserList($args = array())
    {

        $sql = "SELECT u.id, first_name, surname, email, organisation_unit_name, superior_id FROM `users` AS u JOIN organisation_units AS ou ON u.organisation_unit_id = ou.id WHERE u.id > 0 AND user_status_id = ".self::ACTIVE_USER_ID;

        if (isset($args['business_id']) && is_numeric($args['business_id'])) {
            $sql .= " AND business_id = " . $args['business_id'];
        }

        if (isset($args['superior_id']) && is_numeric($args['superior_id'])) {
            $sql .= " AND superior_id = {$args['superior_id']}";
        }

        if (isset($args['user_id_map'])) {
            $sql .= " AND u.id IN (".$args['user_id_map'].")";
        }

        $requests = \DB::select($sql);

        return $requests;

    }

    /**
     * Dumps the user file into a cache file
     *
     * todo move to it's own class > method
     * @param $path
     */
    function createCacheFile($path)
    {

        //get all users for this business
        $allUsers = self::all();

        $arrayForSearch = array();
        foreach ($allUsers AS $key => $value) {
            $arrayForSearch[] = $value->first_name . ' ' . $value->surname . '<span>' . $value->id . '</span>';
        }

        //update json file
        $file = fopen($path, 'w');
        fwrite($file, json_encode($arrayForSearch));
        fclose($file);

    }

    /**
     * Performs check to see if user has any staff
     *
     * @param $superiorID
     * @param int $businessID
     * @return bool
     */
    function isManagement($superiorID = false, $businessID = 1)
    {

        //added if check needs to be called outside of existing instance
        if (empty($superiorID)) {
            $superiorID = $this->id;
        }

        $sql = "SELECT id FROM users WHERE superior_id = $superiorID limit 1";

        if ($staffCheck = \DB::select($sql)) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param string $type
     * @param bool $businessOveride
     * @param bool $userOverrride
     * @return array|string
     */
    function getStructuredTeamData($returnType = 'string', $businessOveride = false, $userOverrride = false)
    {

        //get all users under the user
        $businessID = $this->organisationUnit->business_id;
        $startUserID = $this->id;

        $users = $this->getUserList(array('business_id' => $businessID));

        //pass to sorting function
        $string = $this->sortSuperiors($startUserID, $users);

        //add startUserID to users string for directly reported staff
        $string .= $startUserID;

        if ($returnType == 'string') {
            return $string;
        } elseif ($returnType == 'array') {
            return explode($this->sortDelimter, $string);
        } else {
            return false;
        }

    }

    /**
     * Sorts users recursively
     * @param $startInputLevel
     * @param $elements
     * @return string
     */
    private function sortSuperiors($startInputLevel, $elements)
    {

        $initialElements = $elements;
        $output = '';

        if (!empty($elements)) {
            foreach ($elements AS $key => $array) {
                if ($startInputLevel == $array->superior_id) {
                    $output .= $array->id . $this->sortDelimter;
                    $output .= $this->sortSuperiors($array->id, $initialElements);
                }
            }
        }

        return ($output);

    }

    /**
     * Gets the users who report to the same superior
     * @param string $returnType
     * @param array $args
     * @return array|string
     */
    public function getUserSiblings($returnType = 'string', array $args = [])
    {

        //echo $this->superior_id;

        /** @var Builder $query */
        $query = $this->select('*');

        if (isset($args['superior_id'])) {
            $query->where('superior_id', $this->superior_id);
        }
        
        $query->where('organisation_unit_id', $this->organisation_unit_id);
        $query->orWhere('superior_id', $this->id);

        $result = $query->get(['id']);

        //echo $query->toSql();

        $returnValues = '';

        if (!empty($result)) {
            foreach ($result as $key=>$item) {
                $returnValues .= $item->id.', ';
            }
        }

        if ($returnType == 'string') {
             return rtrim($returnValues, ', ');
        } else {
            return(explode(',',$returnValues));
        }

    }

}
