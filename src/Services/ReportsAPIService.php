<?php
namespace Mobilozophy\accessapiclient\Services;

use Mobilozophy\accessapiclient\Services\Api\ReportsAPIService;

class ReportsService extends ServiceBase
{

    public function __construct(ReportsAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
