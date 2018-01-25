<?php

namespace Powhr\Controllers;

class OrganisationUnitsController extends AuthenticatedController
{
    public function getIndex()
    {
        $units = OrganisationUnits::all();
        return \View::make('general.organisationUnits')->with('organisationUnits', $units);
    }

    public function getUnit()
    {

    }

}