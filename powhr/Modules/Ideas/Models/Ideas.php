<?php

namespace Powhr\Modules\Ideas\Models;
use Illuminate\Database\Eloquent\Model;

class Ideas extends Model
{
    protected $table = 'ideas';

    public function user()
    {
        return $this->belongsTo('\Powhr\Models\User');
    }

    public function IdeasComments()
    {
        return $this->hasMany('Powhr\Modules\Ideas\Models\IdeasComments', 'idea_id');
    }

    public function IdeasLikes()
    {
        return $this->hasMany('Powhr\Modules\Ideas\Models\IdeasLikes');
    }

    public function getStatus()
    {
        return $this->belongsTo('Powhr\Modules\Ideas\Models\IdeaStatus', 'idea_status_id');
    }

}