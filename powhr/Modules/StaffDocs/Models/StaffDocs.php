<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 01/08/2016
 * Time: 18:48
 */

namespace Powhr\Modules\StaffDocs\Models;
use Illuminate\Database\Eloquent\Model;

class StaffDocs extends Model
{

    const MANAGERS = 1;
    const STAFF = 0;

    public $table = 'staff_docs';

    public function getDocuments($args = array())
    {

        $query = $this->join('business AS b', 'business_id', '=', 'b.id');
        $query->join('users AS u', 'staff_docs.user_id', '=', 'u.id');

        if (!empty($args['file_for_business'])) {
            $query->where('business_id', $args['business_id']);
            $query->where('staff_docs.id', $args['staff_docs_id']);
        }

        $results = $query->get(['staff_docs.*', 'b.unique_id']);

        if ($results->isEmpty()) {
            return false;
        }

        if (!empty($args['single'])) {
            return $results[0];
        } else {
            return $results;
        }

    }

}