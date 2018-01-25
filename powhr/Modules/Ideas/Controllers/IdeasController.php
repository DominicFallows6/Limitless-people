<?php

namespace Powhr\Modules\Ideas\Controllers;
use Powhr\Modules\Ideas\Models\Ideas;
use Powhr\Modules\Ideas\Models\IdeasComments;
use Powhr\Modules\Ideas\Models\IdeasLikes;

class IdeasController extends \Powhr\Modules\Ideas\Module
{

    public function getIndex()
    {
        //this may change later for something more efficient
        $ideas = Ideas::with('IdeasComments','IdeasLikes', 'getStatus')->orderBy('ideas.id', 'desc')->paginate(10);
        return \View::make('listIdeas')->with('ideas',$ideas);
    }
	
    public function getExport()
    {	
	
        //this may change later for something more efficient
        $ideas = Ideas::with('IdeasComments','IdeasLikes', 'getStatus')->orderBy('ideas.id', 'desc')->get();
	
	return \View::make('exportList')->with('ideas',$ideas);

    }

    public function getEdit()
    {
        $segment = \Request::segment(3);

        if ($segment == 'new') {
            $model = new \stdClass();
            $model->idea_name = $model->description = '';
            $model->id = 'new';
        } elseif (is_numeric($segment) && Ideas::find($segment)) {
            $model = Ideas::find($segment);
        } else {
            App::abort(404);
        }

        return \View::make('editIdea')->with('idea', $model);

    }

    public function getIdea()
    {
        $segment = \Request::segment(3);

        if (is_numeric($segment) && Ideas::find($segment)) {
            $viewData = array();
            $viewData['idea'] = Ideas::with('IdeasLikes')->find($segment);
            $viewData['comments'] = IdeasComments::where('idea_id','=',$segment)->orderBy('id', 'desc')->get();
        } else {
            \App::abort(404);
        }

        return \View::make('viewIdea')->with('viewData', $viewData);

    }

    public function postEdit()
    {
        $data = \Input::all();

        $rules = array(
            'idea_name' => 'min:3|required',
            'description'=>'min:3|required'
        );

        $validator = \Validator::make($data, $rules);

        //create object dependent on type
        if (!$idea = Ideas::find($data['id'])) {
            $idea = new Ideas();
        }

        if ($validator->passes()) {
            $idea->description = $data['description'];
            $idea->idea_name = $data['idea_name'];
            $idea->user_id = \Auth::user()->id;
            $idea->save();

            \Session::flash('message', "Idea Created!");
            return \Redirect::to('ideas/index');

        } else {
            return \Redirect::to('ideas/edit/'.$data['id'])->withInput()->withErrors($validator);
        }

    }

    public function postAddcomment(\Powhr\Modules\Ideas\Services\IdeasComments $ideasCommentsService) {

        $data = \Input::all();

        $rules = array(
            'new_idea_comment' => 'min:3|required',
            'idea_id'=>'numeric|required'
        );

        $validator = \Validator::make($data, $rules);

        if ($validator->passes()) {

            $idea = new Ideas();
            $ideasComment = new IdeasComments();
            $ideasComment->idea_comment = $data['new_idea_comment'];
            $ideasComment->idea_id = $data['idea_id'];
            $ideasComment->user_id = \Auth::user()->id;
            $ideasComment->save();

            //todo will load through Dependency injection eventually
            $ideasCommentsService->setDependencies($ideasComment, $idea);
            $ideasCommentsService->sendCommentEmails($data['idea_id']);

            \Session::flash('message', "Comment Added!");
            return \Redirect::to('ideas/idea/'.$data['idea_id']);

        } else {
            return \Redirect::to('ideas/idea/'.$data['idea_id'])->withInput()->withErrors($validator);
        }

    }

    public function getAddlike() {

        if (is_numeric(\Request::segment(3))) {

            $addLike = new IdeasLikes();
            $addLike->ideas_id = \Request::segment(3);
            $addLike->users_id = $this->userID;
            $addLike->save();

            \Session::flash('message', "Idea Liked!");

            return \Redirect::to('ideas/idea/'.\Request::segment(3));

        } else {
            return \Redirect::to('ideas/');
        }

    }

    public function getRemovelike()
    {
        if (is_numeric(\Request::segment(3))) {
            \Session::flash('message', 'Like Removed');
            $idea = IdeasLikes::where(array('ideas_id'=>\Request::segment(3), 'users_id'=>\Auth::user()->id))->delete();
            return \Redirect::to('ideas/idea/'.\Request::segment(3));
        }
    }

}
