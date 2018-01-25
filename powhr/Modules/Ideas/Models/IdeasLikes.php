<?php

namespace Powhr\Modules\Ideas\Models;
use Illuminate\Database\Eloquent\Model;

class IdeasLikes extends Model {

    protected $table = 'idea_likes';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('\Powhr\Models\User', 'users_id');
    }

}