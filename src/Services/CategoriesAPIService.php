<?php
namespace Mobilozophy\AccessAPIClient\Services;

use Mobilozophy\AccessAPIClient\Services\Api\CategoriesAPIService;

class CategoriesService extends ServiceBase
{

    public function __construct(CategoriesAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
