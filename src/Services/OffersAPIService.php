<?php
namespace Mobilozophy\accessapiclient\Services;

use Mobilozophy\accessapiclient\Services\Api\OffersAPIService;

class OffersService extends ServiceBase
{

    public function __construct(OffersAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
