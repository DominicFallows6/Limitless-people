<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 22/07/2016
 * Time: 17:08
 */

namespace powhr\Services;

class User
{

    protected $request;

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
    }

    /**
     * Unified place for performing supplementary login functions
     */
    function performLoginfunctions()
    {

        //put in session as logged in user can be override via admin
        if ($this->request->user()->is_admin) {
            $this->request->session()->put('is_admin', 1);
        }

        if ($this->request->user()->powhr_user == 1) {
            $this->request->session()->put('is_powhr', 1);
        }
        
        //add business ID 
        $this->request->session()->put('business_id', $this->request->user()->organisationUnit->business_id);
        $this->request->session()->put('user_id', $this->request->user()->id);

        //grab all descending team userIDs
        $userIDs = $this->request->user()->getStructuredTeamData();
        $this->request->session()->put('reporting_staff_ids', $userIDs);

    }

    function mapToSelect(array $array, $moveIDToTop = false) {
        dd($array);
    }

}