<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 16/07/2016
 * Time: 09:29
 */

namespace powhr\Modules\Ideas\Services;

class IdeasComments
{

    public $ideaComment;
    public $idea;
    public $request;

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
    }

    //will be set via dependency injection
    function setDependencies($ideaComment, $idea)
    {
        $this->ideaComment = $ideaComment;
        $this->idea = $idea;

    }

    public function sendCommentEmails($ideaID)
    {
        //get original poster
        //todo this can be converted to user ids rather than email addresses

        $idea = $this->idea->find($ideaID);
        $ideaPosterEmail = trim($idea->user->email);

        $emails = $this->ideaComment->distinct()
            ->where('idea_id', $ideaID)
            ->where('user_id', '!=', $this->request->user()->id)
            ->get(['user_id']);

        $addresses = array();

        foreach ($emails AS $k => $v) {
            $addresses[] = trim($v->user->email);
        }

        //check if poster has already commented
        $key = array_search($ideaPosterEmail, $addresses);

        if ($key === FALSE) {
            $addresses[] = $ideaPosterEmail;
        }

        //check if this poster has been added
        $newKey = array_search($this->request->user()->email, $addresses);

        if ($newKey !== FALSE) {
            unset($addresses[$newKey]);
        }

        if (!empty($addresses)) {
            \Mail::send('emails.ideaCommentUpdate', ['idea'=>$idea, 'request'=>$this->request], function ($m) use ($addresses, $idea) {
                $m->from(\Config::get("mail.username"));
                $m->to($addresses);
                $m->subject('Some has commented on an idea - '.$idea->idea_name.' you\'re interested in');
            });
        }

    }

}