<?php
namespace Mobilozophy\accessapiclient\Services;

use Mobilozophy\accessapiclient\Services\Api\Credentials;

/**
 * Trait UsesCredentialsTrait
 * @package Mobilozophy\accessapiclient\Services
 */
trait UsesCredentialsTrait
{
    private $credentials;

    /**
     * @param Credentials $credentials
     */
    public function setCredentials(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @return mixed
     */
    protected function getCredentials()
    {
        if ( ! $this->credentials) {
            throw new MissingCredentialsException;
        }

        return $this->credentials;
    }
}
