<?php

namespace Powhr\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrganisationUnits - Core Unit
 * @package Powhr\Models
 */
class OrganisationUnits extends Model
{
    protected $table = 'organisation_units';
    public $timestamps = false;
    
    function business()
    {
        return $this->belongsTo('\Powhr\Models\Business');
    }
    
    function users()
    {
        return $this->hasMany('User');
    }

    function locations()
    {
        return $this->belongsToMany('\Powhr\Models\UnitLocations');
    }

}