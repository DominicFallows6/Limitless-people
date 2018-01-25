<?php

namespace Powhr\Controllers\Admin;
use \Auth;
use \View;
use \Powhr\Models\OrganisationUnits;

class OrganistationUnitsController extends BaseAdminController
{

    public function getIndex()
    {
        $data['organisationUnits'] = OrganisationUnits::all();
        return \View::make('admin.organistationUnitsList')->with('data', $data);
    }

    public function anyEdit() {

    }

}