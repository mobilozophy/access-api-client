<?php
namespace Mobilozophy\accessapiclient\Services;

use Mobilozophy\accessapiclient\Services\Api\ProductGroupsAPIService;

class ProductGroupsService extends ServiceBase
{

    public function __construct(ProductGroupsAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
