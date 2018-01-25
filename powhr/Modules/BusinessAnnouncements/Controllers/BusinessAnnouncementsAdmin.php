<?php
/**
 * Created by PhpStorm.
 * User: jfirminger
 * Date: 11/07/2016
 * Time: 12:13
 */

namespace Powhr\Modules\BusinessAnnouncements\Controllers;


class BusinessAnnouncementsAdmin extends \Powhr\Modules\BusinessAnnouncements\Module implements \Powhr\Contracts\ModuleInterface
{

    public $ba;
    public $request;
    public $moduleConfig;

    function __construct (
        \Powhr\Modules\BusinessAnnouncements\Models\InterfaceBusinessAnnouncements $ba,
        \Illuminate\Http\Request $request,
        \Powhr\Contracts\PublicAssetsInterface $publicAssets
    )
    {
        parent::__construct($request, $publicAssets);
        $this->ba = $ba;
    }

    function getIndex()
    {
        $data = [];
        $data['announcements'] = $this->ba->getAllAnnouncements(['business_id' => $this->request->user()->organisationUnit->business_id]);
        return \View::make('announcementList')->with('data', $data);
    }

    function getEdit($id = false)
    {
        $data = array();

        if (!$data['announcement'] = $this->ba->getItem($id)) {

            $data['announcement'] = new \stdClass();
            $data['announcement']->announcements_content = $data['announcement']-> announcements_name = '';
            $data['announcement']->id = '';

        }

        return \View::make('announcementEdit')->with('data', $data);
    }

    function postEdit()
    {
        $this->validate($this->request, [
            'announcements_title' => 'required|',
            'announcements_content' => 'required',
        ]);

        $data = ($this->request->all());

        if (is_numeric($data['id'])) {

            $model = $this->ba->findOrFail($data['id']);
            $model->announcements_title = $data['announcements_title'];
            $model->announcements_content = $data['announcements_content'];
            $model->save();
            $id = $model->id;

        } else {

            //add details for original poster
            //this may change if we need to track changes
            $this->ba->user_id = $this->request->user()->id;
            $this->ba->business_id = $this->request->user()->organisationUnit->business_id;
            $this->ba->announcements_title = $data['announcements_title'];
            $this->ba->announcements_content = $data['announcements_content'];
            $this->ba->save();
            $id = $this->ba->id;

        }

        return \Redirect::to('/admin/business-announcements/business-announcements-admin');

    }

}