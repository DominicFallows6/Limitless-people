<?php

namespace Powhr\Modules\HolidayRequests\Repositories;
use Powhr\Models\PowhrEloquentModel;
use Powhr\Modules\HolidayRequests\Data\HolidayRequestGroupDataObject;
use Powhr\Modules\HolidayRequests\Interfaces\HolidayRequestsGroupsRepositoryInterface;
use Powhr\Modules\HolidayRequests\Module;

class HolidayRequestGroups extends PowhrEloquentModel implements HolidayRequestsGroupsRepositoryInterface
{
    protected $table = 'holiday_request_groups';
    public $timestamps = false;

    public function HolidayRequests()
    {
        return $this->hasMany('\Powhr\Modules\HolidayRequests\Models\HolidayRequests', 'holiday_request_group_id');
    }

    public function user()
    {
        return $this->belongsTo('\Powhr\Models\User');
    }

    public function saveData(HolidayRequestGroupDataObject $holidayRequestGroupDataObject)
    {
        
        $this->start = $holidayRequestGroupDataObject->getStart();
        $this->end = $holidayRequestGroupDataObject->getEnd();
        $this->user_id = $holidayRequestGroupDataObject->getUserId();
        $this->one_off = $holidayRequestGroupDataObject->getOneOffStatus();
        $this->awaiting_auth = $holidayRequestGroupDataObject->getAwaitingAuth();
        $this->duration_type = $holidayRequestGroupDataObject->getDurationType();
        $this->day_count = $holidayRequestGroupDataObject->getDayCount();
        $this->period = $holidayRequestGroupDataObject->getPeriod();
        $this->holiday_request_type_id = $holidayRequestGroupDataObject->getHolidayRequestTypeId();
        $this->save();

        return $this;

    }

    public function getRequestsForStaff($id, $year)
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = $this->select('holiday_request_groups.*', 'hrt.holiday_request_type_name', 'hrt.needs_approval');
        $query->join('holiday_request_types AS hrt', 'holiday_request_type_id', '=', 'hrt.id');
        $query->where('awaiting_auth', Module::AWAITING_AUTH);
        $query->where('needs_approval', 1);
        $query->where('user_id', $id);
        return $results = $query->get();
    }

    public function updateRequestGroup($id, array $data)
    {

        $holidayRequestGroup = $this->find($id);
        $holidayRequestGroup->awaiting_auth = $data['awaiting_auth'];
        $holidayRequestGroup->period = $data['period'];
        $holidayRequestGroup->save();

        return $holidayRequestGroup;

    }

    public function getRequest($id)
    {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = $this->select('holiday_request_groups.*', 'hrt.holiday_request_type_name', 'hrt.needs_approval', 'staff.first_name', 'staff.surname', 'staff.email');
        $query->join('holiday_request_types AS hrt', 'holiday_request_type_id', '=', 'hrt.id');
        $query->join('users AS staff', 'user_id', '=', 'staff.id');
        $query->where('holiday_request_groups.id', $id);
        return $results = $query->get()->first();
    }

}
