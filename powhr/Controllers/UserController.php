<?php

namespace Powhr\Controllers;
use \Powhr\Models\OrganisationUnits;
use \Powhr\Models\User;
use \Powhr\Models\HolidayRequests;

class UserController extends AuthenticatedController
{

    function getIndex()
    {
    }

    function getSearch($id)
    {
        $users = User::where('first_name', 'LIKE', '%' . $id . '%')->get(array('first_name', 'surname'));
        if (!$users->isEmpty()) {
            echo $users;
        } else {
            echo User::all(array('first_name', 'surname'));
        }
    }

    public function getProfile()
    {
        $org_units = OrganisationUnits::all();
        $selectOrgUnits = array(''=>'Please Select...');

        foreach($org_units AS $key=>$value) {
            $selectOrgUnits[$value->id] = $value->organisation_unit_name;
        }

        return \View::make('user.profileEdit')->with('user', \Auth::user())->with('org_units', $selectOrgUnits);
    }

    public function getView() 
    {
        if ($user = User::find(\Request::segment(3))) {
            return \View::make('user.viewProfile')->with('user', $user);
        } else {
            \App::abort(404);
        }

    }
    
    function getProfileimage()
    {
        return \View::make('user.avatarUpdate');
    }
    
    function postProfileimage()
    {
        
        $allowedtypes = array('image/jpeg');
        $data = \Input::file();

        $rules = array(
            'file'=>'required|mimes:jpeg,bmp,png'
        );

        $validator = \Validator::make($data, $rules);

        if ($validator->passes()) {

            //figure paths
            $path = public_path('images/avatars');
            $accessPath = str_replace(base_path() . '/public', '', $path);

            $file = (\Input::file('file'));

            $file->move($path, $file->getClientOriginalName());
            \Session::flash('message', "Avatar Updated");
            $user = $this->request->user();
            $user->profile_pic = $accessPath . '/' . $file->getClientOriginalName();
            $user->save();

            return \Redirect::to('users/profileimage');

        } else {

            return \Redirect::to('users/profileimage')->withInput()->withErrors($validator);

        }
        
    }

    function postSaveprofile()
    {

        $data = \Input::all();

        $rules = array(
            'first_name' => 'alpha_num|min:3|required',
            'surname' => 'min:3|required',
            'email' => 'required|email',
            'job_title' => 'min:3|required',
            'organisation_unit_id' => 'numeric|required',
            'nickname' => '',
            'description'=>''
        );

        $validator = \Validator::make($data, $rules);

        if ($validator->passes()) {

            $user = \Auth::user();
            $user->first_name = $data['first_name'];
            $user->surname = $data['surname'];
            $user->email = $data['email'];
            $user->job_title = $data['job_title'];
            $user->nickname = $data['nickname'];
            $user->description = $data['description'];
            $user->organisation_unit_id = $data['organisation_unit_id'];
            $user->save();

            $user->createCacheFile(storage_path().'/cache/'.$this->request->user()->organisationUnit->business->unique_id.'.json');
            
            \Session::flash('message', "Profile Updated");
            return \Redirect::to('users/profile');

        } else {
            return \Redirect::to('users/profile')->withInput()->withErrors($validator);
        }
    }
    
    function getChangePassword()
    {
        return \View::make('user.changePassword');
    }

    function postChangePassword(\Illuminate\Http\Request $request)
    {
        
        $validator = $this->validate($request, [
            'password_confirmation' => 'required|',
            'password' => 'required|confirmed',
        ]);

        $credentials = $request->only(
            'password', 'password_confirmation'
        );

        //print_r($credentials);
        $password = \Hash::make($credentials['password']);
        $request->user()->password = $password;
        $request->user()->save();

        \Session::flash('message', "Password Updated");

        return \Redirect::to('/dashboard');

    }

}