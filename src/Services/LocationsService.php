<?php
namespace Mobilozophy\accessapiclient\Services;

use Mobilozophy\accessapiclient\Services\Api\LocationsAPIService;

class LocationsService extends ServiceBase
{

    public function __construct(LocationsAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
