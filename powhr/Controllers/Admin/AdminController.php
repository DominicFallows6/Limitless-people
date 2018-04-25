<?php

namespace Powhr\Controllers\Admin;
use \View;
use \Auth;
use \Input;
use \Validator;
use \Redirect;
use \Session;
use \Powhr\Models\Business;

class AdminController extends \Powhr\Controllers\Admin\BaseAdminController
{

    public function getHome()
    {
        return \View::make('admin.home');
    }

    public function anyBusinessinfo()
    {

        $businessID = \Auth::user()->organisationUnit->business_id;

        if (!empty($_POST)) {

            $data = \Input::all();

            $rules = array(
                'business_name' => 'min:3|required',
                'default_days_leave'=>'numeric|required',
                'start_time'=>'date_format:H:i|required|max:5|min:5',
                'end_time'=>'date_format:H:i|after:start_time|required|max:5|min:5'
            );

            $validator = \Validator::make($data, $rules);

            if ($validator->passes()) {

                $business = Business::find($businessID);
                $business->business_name = $data['business_name'];
                $business->start_time = $data['start_time'];
                $business->end_time = $data['end_time'];
                $business->default_days_leave = $data['default_days_leave'];
                $business->save();

                Session::flash('message', "Business Info Updated");
                return \Redirect::to('admin_dashboard/businessinfo');

            } else {
                return \Redirect::to('admin_dashboard/businessinfo')->withInput()->withErrors($validator);
            }

        } else {
            $data = array();
            $data['business'] = Business::where('id', '=', $businessID)->first();
            return \View::make('admin.businessInfo')->with('data', $data);
        }



    }

}