<?php
namespace Powhr\Controllers\Admin;
use \View;
use \Auth;
use \Powhr\Models\User;
use \Powhr\Models\OrganisationUnits;

class UserController extends BaseAdminController
{

    public function getIndex()
    {
        $users = new User;
        $data['userList'] = $users->getUserList(array('business_id'=>\Auth::User()->organisationUnit->business_id));
        return \View::make('admin.usersList')->with('data', $data);
    }

    /**
     * Logs a user in manually
     * @param $id
     * @return mixed
     */
    public function getLoginAsUser($id, \Powhr\Services\User $serviceUser)
    {
        if (is_numeric($id)) {
            
            

            \Auth::loginUsingId($id);

           

            //sets session information for user
            $serviceUser->performLoginfunctions();

            return \Redirect::to('dashboard');

        }
    }
    
    /**
     * Edits a user
     */
    function getEditUser($id = false)
    {

        $org_units = OrganisationUnits::where('business_id', \Auth::user()->organisationUnit->business_id)->get();
        $data['org_units'] = array(''=>'Please Select...');

        foreach($org_units AS $key=>$value) {
            $data['org_units'][$value->id] = $value->organisation_unit_name;
        }

        if ($data['user'] = User::find($id)) {

            //Move to model
            $otherUsers = User::join('organisation_units', 'users.organisation_unit_id', '=', 'organisation_units.id')
                ->where('organisation_units.business_id',$data['user']->organisationUnit->business_id)
                ->where('users.id', '<>', $id)
		->where('user_status_id', '=', 1)
                ->get(['users.*']);

        } else {

            $data['user'] = new \stdClass();
            $data['user']->id = $data['user']->first_name = $data['user']->surname = $data['user']->email = $data['user']->job_title = $data['user']->organisation_unit_id = $data['user']->nickname = $data['user']->description = $data['user']->superior_id = null;

            //Move to model
            $otherUsers = User::join('organisation_units', 'users.organisation_unit_id', '=', 'organisation_units.id')
                ->where('organisation_units.business_id', $this->userBusinessID)
		->where('user_status_id', '=', 1)
                ->get(['users.*']);

        }

        $data['other_users'] = array(''=>'Please Select...');

        foreach ($otherUsers as $otherUser) {
            $data['other_users'][$otherUser->id] = $otherUser->first_name. ' '.$otherUser->surname;
        }

        return \View::make('admin.editUser')->with('data', $data);

    }

    function postEditUser()
    {
        $data = \Input::all();

        $rules = array(
            'first_name' => 'alpha_num|min:3|required',
            'surname' => 'alpha_num|min:3|required',
            'email' => 'required|email',
            'job_title' => 'min:3|required',
            'organisation_unit_id' => 'numeric|required',
            'nickname' => '',
            'description'=>'',
            'superior_id'=> 'numeric|required',
        );

        if (empty($data['id'])) {
            $rules['password'] = 'alpha_num|min:3|required';
        }

        $validator = \Validator::make($data, $rules);

        if ($validator->passes()) {

            if (!empty($data['id'])) {
                $user = User::find($data['id']);
            } else {
                $user = new User();
                $user->password =  \Hash::make($data['password']);
            }

            $user->first_name = $data['first_name'];
            $user->surname = $data['surname'];
            $user->username = $user->email = $data['email'];
            $user->job_title = $data['job_title'];
            $user->nickname = $data['nickname'];
            $user->description = $data['description'];
            $user->organisation_unit_id = $data['organisation_unit_id'];
            $user->superior_id = $data['superior_id'];
            $user->bonus_days = $data['bonus_days'];
            $user->save();

            $user->createCacheFile(storage_path().'/cache/'.\Auth::user()->organisationUnit->business->unique_id.'.json');

            \Session::flash('message', "Profile Updated");
            return \Redirect::to('users_admin/edit-user/'.$user->id);

        } else {
            return \Redirect::to('users_admin/edit-user/'.$data['id'])->withInput()->withErrors($validator);
        }

    }

    function getDeleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->user_status_id = 2;
        $user->save();

        \Session::flash('message', "User Deleted");
        return \Redirect::to('users_admin/');

    }

}
