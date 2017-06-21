<?php

namespace Lesstif\GitLabApi\Configuration;

/**
 * Class AbstractConfiguration.
 */
abstract class AbstractConfiguration implements ConfigurationInterface
{
    /**
     * api timeout.
     *
     * @var integer
     */
    protected $timeout;

    /**
     * gitlab host.
     *
     * @var string
     */
    protected $gitlabHost;

    /**
     * gitlab token.
     *
     * @var string
     */
    protected $gitlabToken;

    /**
     * Path to log file.
     *
     * @var string
     */
    protected $logFile;

    /**
     * Log level (DEBUG, INFO, ERROR, WARNING).
     *
     * @var string
     */
    protected $logLevel;

    /**
     * Curl options CURLOPT_SSL_VERIFYHOST.
     *
     * @var bool
     */
    protected $curlOptSslVerifyHost;

    /**
     * Curl options CURLOPT_SSL_VERIFYPEER.
     *
     * @var bool
     */
    protected $curlOptSslVerifyPeer;

    /**
     * Curl options CURLOPT_VERBOSE.
     *
     * @var bool
     */
    protected $curlOptVerbose;

    /**
     * @return string
     */
    public function getGitLabHost()
    {
        return $this->gitlabHost;
    }

    /**
     * @return string
     */
    public function getGitlabToken()
    {
        return $this->gitlabToken;
    }


    /**
     * @return string
     */
    public function getLogFile()
    {
        return $this->logFile;
    }

    /**
     * @return string
     */
    public function getLogLevel()
    {
        return $this->logLevel;
    }

    /**
     * @return bool
     */
    public function isCurlOptSslVerifyHost()
    {
        return $this->curlOptSslVerifyHost;
    }

    /**
     * @return bool
     */
    public function isCurlOptSslVerifyPeer()
    {
        return $this->curlOptSslVerifyPeer;
    }

    /**
     * @return bool
     */
    public function isCurlOptVerbose()
    {
        return $this->curlOptVerbose;
    }
}
