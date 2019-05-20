<?php

namespace Mobilozophy\AccessAPIClient\Services\Api;

use GuzzleHttp\Client;
use InvalidArgumentException;

abstract class AbstractAPIService
{
    protected $httpClient;

    /**
     * Create a new API service.
     *
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Get endopoint API request URL with additional segments.
     *
     * @param mixed $segments
     * @return string
     */
    protected function getEndpointRequestUrl($segments = null)
    {
        return $this->getBaseRequestUrl(array_merge([static::ENDPOINT], (array) $segments));
    }

    /**
     * Get base API request URL with additional segments.
     *
     * @param mixed $segments
     * @return string URI
     */
    protected function getBaseRequestUrl($segments = null)
    {
        if (is_array($segments)) {
            $segments = implode('/', $segments);
        }

        return $segments ? (env('MZCAPI_BASEURL') . $segments) : env('MZCAPI_BASEURL');
    }

    /**
     * Get filtered input data.
     *
     * @param array $data
     * @param array $keys
     * @return array Fitered data
     */
    protected function pruneInputData(array $data, array $keys)
    {
        $data = array_only($data, $keys);
        $data = array_where($data, function($key, $value) {
            return is_scalar($value) || is_array($value);
        });

        return $data;
    }

    /**
     * Validate input data.
     *
     * @param array $data
     * @param array $required Required field names
     */
    protected function validateInputData(array $data, array $required)
    {
        if ( ! $this->arrayHasFields($data, $required)) {
            $missing = $this->getMissingFields($data, $required);
            throw new InvalidArgumentException(
                'Missing required fields "' . implode(', ', $missing) . '".'
            );
        }
    }

    /**
     * Check if all fields are present in an array.
     *
     * @param array $array
     * @param array $fields
     * @return boolean
     */
    protected function arrayHasFields(array $array, array $fields)
    {
        return count($this->getMissingFields($array, $fields)) ? false : true;
    }

    /**
     * Get an array of fields missing from an array.
     * @param array $array
     * @param array $fields
     * @return array
     */
    protected function getMissingFields(array $array, array $fields)
    {
        $keys = array_keys($array);
        return array_diff($fields, $keys);
    }
}
