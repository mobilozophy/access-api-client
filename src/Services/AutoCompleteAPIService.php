<?php
namespace Mobilozophy\accessapiclient\Services;

use Mobilozophy\accessapiclient\Services\Api\AutoCompleteAPIService;

class AutoCompleteService extends ServiceBase
{

    public function __construct(AutoCompleteAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

}
