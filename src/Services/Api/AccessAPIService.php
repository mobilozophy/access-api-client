<?php
namespace Mobilozophy\accessapiclient\Services\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\str;
use InvalidArgumentException;

/**
 * Class AccessAPIService
 * @package Mobilozophy\accessapiclient\Services\Api
 */
class AccessAPIService extends AbstractAPIService
{

    /**
     * Send a request to add a new resource.
     *
     * @param Credentials $credentials
     * @param array $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function add(Credentials $credentials, array $params)
    {
        $requestUrl = $this->getEndpointRequestUrl();

            return $this->httpClient->post(
                $requestUrl,
                $this->generateOptions($credentials,
                    [
                        'form_params' => $params,
                    ]
                )
            );
    }

    public function addWithJsonPayload(Credentials $credentials, array $params)
    {
        $requestUrl = $this->getEndpointRequestUrl();

            return $this->httpClient->post(
                $requestUrl,
                $this->generateOptions($credentials,
                    [
                        'json' => $params,
                        'debug' => false
                    ]
                )
            );
    }

    /**
     * Send a request to update a resource
     *
     * @param Credentials $credentials
     * @param             $id
     * @param array       $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(Credentials $credentials, $id, array $params)
    {
        $requestUrl = $this->getEndpointRequestUrl($id);

        return $this->httpClient->put(
            $requestUrl,
            $this->generateOptions($credentials,
                [
                    'form_params' => $params,
                ]
            )
        );

    }

    /**
     * Send a request to retrieve a resource.
     *
     * @param Credentials $credentials
     * @param string $id
     * @param string $include
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get(Credentials $credentials, $id, $query_parameters, $memberKey)
    {
        $requestUrl = $this->getEndpointRequestUrl($id);
        $queryParameters = array_merge($query_parameters, [
            'member_key' => $memberKey
        ]);

        return $this->httpClient->get(
            $requestUrl,
            $this->generateOptions($credentials,
                [
                    'query' => $queryParameters
                ]
            )
        );

    }


    /**
     * Send a request to retrieve all resources.
     *
     * @param Credentials $credentials
     * @return mixed
     */
    public function getAll(Credentials $credentials, $memberKey, $query_parameters)
    {
        $requestUrl = $this->getEndpointRequestUrl();
        return $this->httpClient->get(
            $requestUrl,
            $this->generateOptions($credentials,
                [
                   'json'   => ['member_key' => $memberKey],
                    'query' => $query_parameters
                ]
            )
        );

    }


    /**
     * Send a request to delete a resource
     * .
     * @param Credentials $credentials
     * @param string $id
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete(Credentials $credentials, $id)
    {
        $requestUrl = $this->getEndpointRequestUrl($id);
        return $this->httpClient->delete(
            $requestUrl,
            $this->generateOptions($credentials)
        );
    }


    /**
     * Get base API request URL with additional segments.
     *
     * @param mixed $segments Segments of the URL
     *
     * @param string $api_scope
     * @return string
     */
    protected function getBaseRequestUrl($segments, $api_scope)
    {
        if (is_array($segments)) {
            $segments = implode('/', $segments);
        }

        if($api_scope === 'offer') {
            if ($segments) {
                return (config('access.ACCESS_BASEURL') . $segments);
            } else {
                return config('access.ACCESS_BASEURL');
            }
        } elseif ($api_scope === 'redeem') {
            if ($segments) {
                return (config('access.ACCESS_REDEMPTION_BASEURL') . $segments);
            } else {
                return config('access.ACCESS_REDEMPTION_BASEURL');
            }
        } elseif ($api_scope === 'amt') {
            if ($segments) {
                return (config('access.ACCESS_AMT_BASEURL') . $segments);
            } else {
                return config('access.ACCESS_AMT_BASEURL');
            }
        }
    }

    protected function generateOptions(Credentials $credentials, $options = null)
    {

        $base = [
            'headers' => $credentials->getHeaders(),
        ];

        if (isset($options)) {
            $base = array_merge($base, $options);
        }

        //Check if we need to proxy the request; really only to be used in a development environement
        if (config('access.PROXY_REQUESTS_IP_PORT', false)) {
            if ( is_bool(config('access.PROXY_REQUESTS_IP_PORT', false)) ){
                $address = gethostbyname(trim(exec("hostname"))).':8888';
            }else
            {
                $address = config('access.PROXY_REQUESTS_IP_PORT');
            }
            $proxy = [
                'proxy' => 'http://' . $address,
            ];
            $base = array_merge($base, $proxy);
        }

        return $base;

    }
}
