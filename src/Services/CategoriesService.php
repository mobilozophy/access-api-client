<?php
namespace Mobilozophy\accessapiclient\Services;

use Mobilozophy\accessapiclient\Services\Api\CategoriesAPIService;

class CategoriesService extends ServiceBase
{

    public function __construct(CategoriesAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
