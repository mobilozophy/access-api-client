<?php
namespace Mobilozophy\accessapiclient\Services;

use Mobilozophy\accessapiclient\Services\Api\StoresAPIService;

class StoresService extends ServiceBase
{

    public function __construct(StoresAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
