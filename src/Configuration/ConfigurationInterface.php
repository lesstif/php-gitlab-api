<?php
namespace Lesstif\GitLabApi\Configuration;

/**
 * Interface ConfigurationInterface.
 */
interface ConfigurationInterface
{
    /**
     * GitLab host.
     *
     * @return string
     */
    public function getGitLabHost();

    /**
     * gitlab token.
     *
     * @return string
     */
    public function getGitlabToken();

    /**
     * Path to log file.
     *
     * @return string
     */
    public function getLogFile();

    /**
     * Log level (DEBUG, INFO, ERROR, WARNING).
     *
     * @return string
     */
    public function getLogLevel();

    /**
     * Curl options CURLOPT_SSL_VERIFYHOST.
     *
     * @return bool
     */
    public function isCurlOptSslVerifyHost();

    /**
     * Curl options CURLOPT_SSL_VERIFYPEER.
     *
     * @return bool
     */
    public function isCurlOptSslVerifyPeer();

    /**
     * Curl options CURLOPT_VERBOSE.
     *
     * @return bool
     */
    public function isCurlOptVerbose();

    /**
     * API timeout(second)
     *
     * @return integer
     */
    public function getTimeout();
}
