<?php
namespace Mobilozophy\AccessAPIClient\Services;

use Mobilozophy\AccessAPIClient\Services\Api\LocationsAPIService;

class LocationsService extends ServiceBase
{

    public function __construct(LocationsAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
