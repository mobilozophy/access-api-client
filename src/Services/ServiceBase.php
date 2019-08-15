<?php
namespace Mobilozophy\accessapiclient\Services;

use Mobilozophy\accessapiclient\Services\Api\Credentials;

/**
 * Class ServiceBase
 * @author Jeffrey Wray <jwray@mobilozophy.com>
 * @package Mobilozophy\MZCAPILaravel\Services
 */
class ServiceBase
{
    use UsesCredentialsTrait;

    protected $apiService;


    /**
     * @param array $data Data to be submitted
     * @param null|string $account_uuid The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return bool|mixed
     */
    public function add(array $data, $account_uuid = null, $scope = false, $otherHeaders=[])
    {

        $response = $this->apiService->add(
            $this->getSubAccountCredentials($otherHeaders), $data
        );
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        } else
        {
            return false;
        }
    }


    /**
     * @param string $id Id (UUID) of the record to be updated.
     * @param array $data Data to be submitted.
     * @param null|string $account_uuid The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return bool|mixed
     */
    public function update($id, array $data, $account_uuid = null, $scope = false, $otherHeaders=[])
    {

        $response = $this->apiService->update(
            $this->getSubAccountCredentials($otherHeaders), $id, $data, $account_uuid
        );
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        } else
        {
            return false;
        }
    }


    /**
     * @param string $id Id (UUID) of the record to be retrieved.
     * @param null|string $account_uuid The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @param null|array|string $include Related items to include in response.
     * @return bool|mixed
     */
    public function get($id, $query_parameters=[], $otherHeaders=[], $memberKey = 'guest')
    {
        $response = $this->apiService->get(
            $this->getSubAccountCredentials($otherHeaders),
            $id,
            $query_parameters,
            $memberKey
        );

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        } else
        {
            return false;
        }
    }

    /*
     * @param null|string $account_uuid The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return bool|mixed
     */
    public function getall($query_parameters=[], $otherHeaders=[], $memberKey = 'guest')
    {
        $response = $this->apiService->getAll(
            $this->getSubAccountCredentials($otherHeaders),
            $memberKey,
            $query_parameters
        );

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        } else
        {
            return false;
        }
    }


    /**
     * @param string $id Id (UUID) of the record to be deleted.
     * @param null|string $account_uuid The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return bool|mixed
     */
    public function delete($id, $account_uuid = null, $scope = false, $otherHeaders=[])
    {
        $response = $this->apiService->delete(
            $this->getSubAccountCredentials($otherHeaders), $id
        );
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents());
        } else
        {
            return false;
        }
    }

    /**
     * Get Account Credentials for API Calls
     * @param null|string $account The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return Credentials
     */
    public function customSubAccountCredentials($token, $otherHeaders = array())
    {

        $headers =             [
            'Accept'    => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $headers = array_merge($headers, $otherHeaders);

        return new Credentials(
            $token,
            $headers

        );
    }


    /**
     * Get Account Credentials for API Calls
     * @param null|string $account The account id of the account to perform this call on.
     * @param bool|string $scope The scope to apply to call (ex. with-children will scope to all child accounts).
     * @param array $otherHeaders Other headers to apply to call.
     * @return Credentials
     */
    public function getSubAccountCredentials($otherHeaders = array())
    {

        $headers =             [
            'Accept'    => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $headers = array_merge($headers, $otherHeaders);

        return new Credentials(
            env('ACCESS_TOKEN'),
            $headers

        );
    }

    /**
     * @param $exception
     * @return string
     */
    protected function handleErrorException($exception)
    {
        $responseBody = $exception->getResponse()->getBody()->getContents();
        $exceptionCode = $exception->getCode();
        $responseJsonDecode = json_decode($responseBody,true);
        unset($responseJsonDecode['error']['debug']);
        return json_encode($responseJsonDecode);

    }
}
