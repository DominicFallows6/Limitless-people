<?php

namespace Powhr\Controllers;
use \Powhr\Models\OrganisationUnits;
use \Powhr\Models\User;

class Account extends BaseController
{

    public function getLogin()
    {
        if (\Auth::check())
        {
            return \Redirect::to('dashboard');
        }

        return \View::make('account.login');

    }

    public function postLogin(\Powhr\Services\User $serviceUser)
    {

        $data = \Input::all();

        $rules = array(
            'password' => 'min:3|required',
            'email' => 'required|email',
        );

        $validator = \Validator::make($data, $rules);

        if ($validator->passes()) {

            $credentials = \Input::only('email', 'password');

            $credentials['user_status_id'] = 1;

            if (\Auth::attempt($credentials)) {

                //sets session information for user
                $serviceUser->performLoginfunctions();

                return \Redirect::intended('/dashboard')->with('message', 'You are now logged in');

            } else {
                return \Redirect::to('/account/login')->with('message', 'Sorry, your account is not currently active - please contact H.R.');
            }

        } else {
            return \Redirect::to('/account/login')->withInput()->withErrors($validator);
        }
    }

    public function getRegister()
    {

        if (\Auth::check())
        {
            return \Redirect::to('dashboard');
        }

        $org_units = OrganisationUnits::all();
        $selectOrgUnits = array(''=>'Please Select...');

        foreach($org_units AS $key=>$value) {
            $selectOrgUnits[$value->id] = $value->organisation_unit_name;
        }

        return \View::make('account.register')->with('org_units', $selectOrgUnits);

    }

    public function postRegister()
    {

        $data = \Input::all();

        $rules = array(
            'password' => 'alpha_num|min:3|required',
            'first_name' => 'alpha_num|min:3|required',
            'surname' => 'alpha_num|min:3|required',
            'email' => 'unique:users|required|email',
            'organisation_unit_id' => 'numeric|required',
        );

        $validator = \Validator::make($data, $rules);

        if ($validator->passes()) {

            $user = new User;
            $user->username = \Input::get('email');
            $user->email = \Input::get('email');
            $user->first_name = \Input::get('first_name');
            $user->surname = \Input::get('surname');
            $user->organisation_unit_id = \Input::get('organisation_unit_id');
            $user->password = \Hash::make(\Input::get('password'));
            $user->superior_id = 4;
            $user->save();

            $credentials = \Input::only('email', 'password');

            if (\Auth::attempt($credentials)) {

                //refactor for usage of above instance
                \Auth::user()->createCacheFile(storage_path().'/cache/'.\Auth::user()->organisationUnit->business->unique_id.'.json');

                return \Redirect::intended('/users/profile')->with('message', 'Registration Successful, please now complete your profile');

            } else {
                return \Redirect::to('/account/register')->with('message', 'Login problem. Please contact I.T. support');
            }

        } else {
            return \Redirect::to('account/register')->withInput()->withErrors($validator);
        }
    }


    public function getLogout() {
        \Auth::logout();
        return \Redirect::to('/')->with('message', 'You are now logged out');
    }

}