<?php


namespace Powhr\Modules\Ideas\Controllers;

use Powhr\Modules\Ideas\Module;
use Powhr\Modules\Ideas\Models\Ideas;
use Powhr\Modules\Ideas\Models\IdeaStatus;

class IdeasAdmin extends Module
{

    public function getIndex()
    {
        $data['ideas'] = Ideas::with('IdeasComments','IdeasLikes', 'getStatus')->orderBy('ideas.id', 'desc')->get();
        return \view('ideasListAdmin')->with('data', $data);
    }

    public function getEdit()
    {

        $segment = $this->request->segment(5);

        if (is_numeric($segment) && Ideas::find($segment)) {
            $data['idea'] = Ideas::find($segment);
        } else {
            App::abort(404);
        }

        $data['idea_statuses'] = IdeaStatus::lists('idea_status_name', 'id');

        return \View::make('editIdeaAdmin')->with('data', $data);

    }

    public function postEdit()
    {
        $data = \Input::all();

        $rules = array(
            'idea_name' => 'min:3|required',
            'description'=>'min:3|required',
            'idea_status_id' => 'numeric|required',
            'idea_feedback' => '',
            'id' => 'numeric|required'
        );

        $validator = \Validator::make($data, $rules);

        //create object dependent on type
        if (!$idea = Ideas::find($data['id'])) {
            $idea = new Ideas();
        }

        if ($validator->passes()) {

            $idea->description = $data['description'];
            $idea->idea_name = $data['idea_name'];
            $idea->idea_status_id = $data['idea_status_id'];
            $idea->idea_feedback = $data['idea_feedback'];
            $idea->id = $data['id'];
            $idea->save();

            \Session::flash('message', "Idea Updated!");
            return \Redirect::to('/admin/ideas/ideas-admin');

        } else {
            return \Redirect::to('ideas/edit/'.$data['id'])->withInput()->withErrors($validator);
        }

    }

}