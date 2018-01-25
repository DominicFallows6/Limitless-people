<?php

namespace Powhr\Modules\StaffDocs\Controllers;

use Faker\Provider\Uuid;

class StaffDocsAdmin extends \Powhr\Modules\StaffDocs\Module
{

    protected $staffDocs;

    public function __construct(
        \Illuminate\Http\Request $request,
        \Powhr\Contracts\PublicAssetsInterface $publicAssets,
        \Powhr\Modules\StaffDocs\Models\StaffDocs $staffDocs)
    {
        $this->staffDocs = $staffDocs;
        parent::__construct($request, $publicAssets);
    }

    public function getIndex()
    {

        $data = [];
        $data['uploads']['url'] = '/admin/staff-docs/staff-docs-admin/do-upload';
        $data['uploads']['method'] = 'POST';
        $data['uploads']['id'] = 'my-dropzone';
        $data['uploads']['name'] = 'my-dropzone';
        $data['uploads']['classes'] = 'dropzone';

        //drop down options
        $options = [
            'viewable_by' => [
                'label' => 'Who can see?',
                'validation' => array('required: true'),
                'values' => array('' => 'Please Select...', 1 => 'Managers', 2 => 'All')
            ]
        ];

        $data['uploads']['options'] = $options;

        return \View::make('uploadFiles')->with('data', $data);

    }

    public function postDoUpload()
    {

        $uploadIDToUse = $_POST['upload_id'];

        if (is_numeric($uploadIDToUse)) {

            $key = 'viewable_by_' . $uploadIDToUse;
            $visibilityID = $_POST[$key];

            $file = $this->request->file('file');
            $fileName = $file->getClientOriginalName();
            $fileSize = $file->getClientSize();
            $extension = $file->getClientOriginalExtension();
            $clientMimeType = $file->getClientMimeType();
            $mimeType = $file->getMimeType();
            $urlToSave = storage_path() . '/app/staff-docs/' . $this->request->user()->organisationUnit->business->unique_id.'/'.date('Y-m');
            $storageName = Uuid::uuid();

            //save to DB
            $this->staffDocs->business_id = $this->userBusinessID;
            $this->staffDocs->user_id = $this->userID;
            $this->staffDocs->asset_name = $storageName;
            $this->staffDocs->original_name = $fileName;
            $this->staffDocs->asset_url = $urlToSave;
            $this->staffDocs->description = '';
            $this->staffDocs->asset_size = $fileSize;
            $this->staffDocs->type = $mimeType;
            $this->staffDocs->extension = $extension;
            $this->staffDocs->visibility = $visibilityID;
            $this->staffDocs->save();

            $file->move($urlToSave, $storageName);

        }


    }


}