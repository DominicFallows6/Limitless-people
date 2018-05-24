<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 10/07/2016
 * Time: 18:32
 */

namespace Powhr\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Base Class powhrEloquentModel for Eloquent Models
 * @package Powhr\Models
 */
class UserModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];
}