<?php
namespace Mobilozophy\accessapiclient\Services;

use Mobilozophy\accessapiclient\Services\Api\MemberManagementAPIService;

class MemberManagementService extends ServiceBase
{

    public function __construct(MemberManagementAPIService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @param array $data Data to be submitted
     * @param null|string $account_uuid The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return bool|mixed
     */
    public function add(array $data, $account_uuid = null, $scope = false, $otherHeaders=[])
    {

        $response = $this->apiService->addWithJsonPayload(
            $this->getSubAccountCredentialsAMT($otherHeaders), $data
        );
        if ($response->getStatusCode() == 201) {
            return json_decode($response->getBody()->getContents());
        } else
        {
            return false;
        }
    }

}
