<?php

namespace Powhr\Modules\Ideas\Models;
use Illuminate\Database\Eloquent\Model;

class IdeasComments extends Model {

    protected $table = 'idea_comments';

    public function user()
    {
        return $this->belongsTo('\Powhr\Models\User');
    }

}