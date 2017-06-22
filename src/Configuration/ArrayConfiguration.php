<?php
namespace Lesstif\GitLabApi\Configuration;

/**
 * Class ArrayConfiguration.
 */
class ArrayConfiguration extends AbstractConfiguration
{
    /**
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->logLevel = 'gitlab-client.log';
        $this->logLevel = 'WARNING';
        $this->curlOptSslVerifyHost = false;
        $this->curlOptSslVerifyPeer = false;
        $this->curlOptVerbose = false;

        foreach ($configuration as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        $this->timeout = 60 * $this->timeout;
    }

    /**
     * API timeout(second)
     *
     * @return integer
     */
    public function getTimeout()
    {
        return $this->timeout;
    }
}
