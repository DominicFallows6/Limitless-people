<?php

namespace Powhr\Modules\StaffDocs\Controllers;
use Illuminate\Http\Response;
use Powhr\Modules\StaffDocs\Models\StaffDocs AS ModelDocs;

class StaffDocs extends \Powhr\Modules\StaffDocs\Module
{

    protected $staffDocs;

    public function __construct(
        \Illuminate\Http\Request $request,
        \Powhr\Contracts\PublicAssetsInterface $publicAssets,
        \Powhr\Modules\StaffDocs\Models\StaffDocs $staffDocs)
    {
        parent::__construct($request, $publicAssets);
        $this->staffDocs = $staffDocs;

    }

    public function getIndex(\Powhr\ViewHelpers\IconMaps $iconMaps)
    {
        $iconHelper = $iconMaps;
        $data['staff_docs'] = $this->staffDocs->getDocuments();
        return \View::make('listFiles')->with('data', $data)->with('iconHelper', $iconHelper);
    }

    public function getDownloadFile($id)
    {
        if ($document =  $this->staffDocs->getDocuments([
            'single' => true,
            'file_for_business' => true,
            'business_id' => $this->userBusinessID,
            'staff_docs_id' => $id,
        ])) {

            $fileURL = $document->asset_url.'/'.$document->asset_name;
            $fileName = $document->original_name;

            return response()->download($fileURL, $fileName);

        } else {

            $this->request->session()->flash('message', "File not found or no access");
            return \Redirect::to('/staff-docs');

        }

    }

}