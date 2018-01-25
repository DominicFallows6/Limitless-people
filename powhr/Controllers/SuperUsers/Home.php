<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 22/07/2016
 * Time: 12:17
 */

namespace powhr\Controllers\SuperUsers;

use Illuminate\Pagination\Paginator;
use Powhr\Models\Business;
use Powhr\Models\Modules;
use Powhr\Models\ModulesBusiness;
use Powhr\Models\OrganisationUnits;
use \Validator;

class Home extends \Powhr\Controllers\SuperUsers\BaseSuperUser
{

    public function getIndex()
    {
        return \View::make('superuser.dashboard');
    }
    
    public function getListBusinesses(Business $business)
    {
        $data['businesses'] = $business->listBusinesses();
        return \View::make('superuser.listBusinesses')->with('data', $data);
    }

    public function getAddBusiness()
    {
        return \View::make('superuser.addBusiness');
    }

    public function postAddBusiness(Business $business, \Powhr\Models\OrganisationUnits $organisationUnits, \Powhr\Models\UnitLocations $unitLocations)
    {

        $this->validate($this->request, [
            'business_name' => 'required|max:25',
            'business_units' => 'required',
            'default_days_leave' => 'required|numeric',
            'unit_locations' => 'required'
        ]);

        //prepare data for what we need
        $indivUnits = \Input::get('business_units');
        $indivUnits = explode(',', trim($indivUnits,','));

        //prepare data for what we need
        $indivUnitLocations = \Input::get('unit_locations');
        $indivUnitLocations = explode(',', trim($indivUnitLocations,','));

        //create a unique from DB - maybe a better to way to get this
        $createUUID = \DB::select('SELECT uuid() AS uuid');

        $businessDBData = \Input::get();
        $businessDBData['unique_id'] = $createUUID[0]->uuid;

        //create and return new business ID
        $businessID = $business->addBusiness($businessDBData);

        if (is_array($indivUnits)) {
            foreach ($indivUnits as $key => $unit) {
                $businessUnit = new $organisationUnits;
                $businessUnit->business_id = $businessID;
                $businessUnit->organisation_unit_slug = str_slug($unit);
                $businessUnit->organisation_unit_name = $unit;
                $businessUnit->save();
            }
        }

        if (is_array($indivUnitLocations)) {
            foreach ($indivUnitLocations as $keyLoc => $unitLoc) {
                $unitLocation = new $unitLocations;
                $unitLocation->business_id = $businessID;
                $unitLocation->unit_location_slug = '';
                $unitLocation->building_name = $unitLoc;
                $unitLocation->building_address = '';
                $unitLocation->save();
            }
        }

        return redirect('/powhruser/list-businesses');


    }

    /**
     * @param Modules $modules
     */
    public function getListModules(Modules $modules) {
        $data = array();
        $data['modules_list'] = $modules->getModuleList();
        return \View::make('superuser.listModules')->with('data', $data);
    }

    public function getEditBusiness($id, Business $business, ModulesBusiness $modulesBusiness, Modules $modules)
    {
        $data = [];
        $currentSubscriptions = $modulesBusiness->getFlatBusinessSubscriptions(['business_id'=>1]);
        $data['modules_list'] = $modules->getModuleList(['exclude'=>$currentSubscriptions]);
        $data['business'] = $business->getBusiness();

        return \View::make('superuser.editBusiness')->with('data', $data);


    }

}