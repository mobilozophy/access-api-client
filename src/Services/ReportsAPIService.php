<?php
namespace Mobilozophy\AccessAPIClient\Services;

use Mobilozophy\AccessAPIClient\Services\Api\ReportsAPIService;

class ReportsService extends ServiceBase
{

    public function __construct(ReportsAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
