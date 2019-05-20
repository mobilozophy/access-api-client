<?php
namespace Mobilozophy\AccessAPIClient\Services;

use Mobilozophy\AccessAPIClient\Services\Api\StoresAPIService;

class StoresService extends ServiceBase
{

    public function __construct(StoresAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
