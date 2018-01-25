<?php

namespace Powhr\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Business - Core Unit
 * @package Powhr\Models
 */
class Business extends PowhrEloquentModel
{
    protected $table = 'business';
    
    public function orgUnits() 
    {
        return $this->hasMany('\Powhr\Models\OrganisationUnits');
    }

    public function listBusinesses()
    {
        return $this->all();
    }

    function addBusiness($data)
    {
        $this->business_name = $data['business_name'];
        $this->unique_id = $data['unique_id'];
        $this->default_days_leave = $data['default_days_leave'];
        $this->save();

        return $this->id;
    }

    function getBusiness()
    {
        return $this->find(1);
    }
    
}
