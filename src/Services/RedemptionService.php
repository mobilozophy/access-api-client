<?php
namespace Mobilozophy\accessapiclient\Services;

use Mobilozophy\accessapiclient\Services\Api\RedemptionAPIService;

class RedemptionService extends ServiceBase
{

    public function __construct(RedemptionAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
