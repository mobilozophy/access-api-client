<?php
namespace Mobilozophy\AccessAPIClient\Services;

use Mobilozophy\AccessAPIClient\Services\Api\ProductGroupsAPIService;

class ProductGroupsService extends ServiceBase
{

    public function __construct(ProductGroupsAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
