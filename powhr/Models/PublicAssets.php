<?php

namespace powhr\Models;
use Illuminate\Database\Eloquent\Model;

class PublicAssets extends Model implements \Powhr\Contracts\PublicAssetsInterface
{

    protected $table = 'public_assets';
    public $timestamps = false;

    public function getAssets($businessID)
    {
        $query = $this->join('business AS b', 'business_id', '=', 'b.id');
        $query->where('business_id', $businessID);
        
        return $query->get([\DB::raw('CONCAT("/",unique_id,"/",asset_type,"/",asset_url) AS asset_path'), 'asset_type']);

    }

    public function getAssetsByType($type, $businessID)
    {

    }

}