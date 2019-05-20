<?php
namespace Mobilozophy\AccessAPIClient\Services;

use Mobilozophy\AccessAPIClient\Services\Api\AutoCompleteAPIService;

class AutoCompleteService extends ServiceBase
{

    public function __construct(AutoCompleteAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
