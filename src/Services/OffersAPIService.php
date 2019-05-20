<?php
namespace Mobilozophy\AccessAPIClient\Services;

use Mobilozophy\AccessAPIClient\Services\Api\OffersAPIService;

class OffersService extends ServiceBase
{

    public function __construct(OffersAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
