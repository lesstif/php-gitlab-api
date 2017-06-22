<?php

namespace Lesstif\GitLabApi;

use Lesstif\GitLabApi\GitLabException;

use Lesstif\GitLabApi\Configuration\ConfigurationInterface;
use Lesstif\GitLabApi\Configuration\DotEnvConfiguration;
use Monolog\Logger as Logger;
use Monolog\Handler\StreamHandler;

class HttpClient
{
	/**
	 * JIRA REST API URI.
	 *
	 * @var string
	 */
	protected $API_VERSION = '/api/v4/';

	/**
	 * GitLab Rest API Configuration.
	 *
	 * @var ConfigurationInterface
	 */
	protected $configuration;

	/**
	 * Monolog instance.
	 *
	 * @var \Monolog\Logger
	 */
	protected $log;

	/**
	 * Json Mapper.
	 *
	 * @var \JsonMapper
	 */
	protected $json_mapper;

	private $gitLabHost;
	private $gitLabToken;

	/**
	 * HttpClient constructor.
	 * @param ConfigurationInterface|null $configuration
	 * @param Logger|null $logger
	 * @param string $path
	 */
	public function __construct(ConfigurationInterface $configuration = null, Logger $logger = null, $path = './')
	{
		if ($configuration === null) {
			if (!file_exists($path . '.env')) {
				// If calling the getcwd() on laravel it will returning the 'public' directory.
				$path = '../';
			}
			$configuration = new DotEnvConfiguration($path);
		}

		$this->configuration = $configuration;
		$this->json_mapper = new \JsonMapper();

		$this->json_mapper->undefinedPropertyHandler = [\Lesstif\GitLabApi\JsonMapperHelper::class, 'setUndefinedProperty'];

		// create logger
		if ($logger) {
			$this->log = $logger;
		} else {
			$this->log = new Logger('GitLabClient');
			$this->log->pushHandler(new StreamHandler(
				$configuration->getLogFile(),
				$this->convertLogLevel($configuration->getLogLevel())
			));
		}

		// prop setting
		$this->gitLabHost = $this->configuration->getGitLabHost();
		$this->gitLabToken = $this->configuration->getGitlabToken();

	}

	/**
	 * Convert log level.
	 *
	 * @param $log_level
	 *
	 * @return int
	 */
	private function convertLogLevel($log_level)
	{
		$log_level = strtoupper($log_level);

		switch ($log_level) {
			case 'EMERGENCY':
				return Logger::EMERGENCY;
			case 'ALERT':
				return Logger::ALERT;
			case 'CRITICAL':
				return Logger::CRITICAL;
			case 'ERROR':
				return Logger::ERROR;
			case 'WARNING':
				return Logger::WARNING;
			case 'NOTICE':
				return Logger::NOTICE;
			case 'DEBUG':
				return Logger::DEBUG;
			case 'INFO':
				return Logger::INFO;
			default:
				return Logger::WARNING;
		}
	}

	/*
	public function get($id)
	{
		return $this->request('users/' . $id);
	}
	*/

	/**
	 * performing gitlab api request
	 *
	 * @param $uri API uri
	 * @return type json response
	 */
	public function request($uri)
	{
		$client = new \GuzzleHttp\Client([
            'base_uri' => $this->gitLabHost,
            'timeout'  => $this->configuration->getTimeout(),
            'verify' => false,
            ]);

        $response = $client->get($this->gitLabHost . $this->API_VERSION . $uri, [
            'query' => [
                'private_token' => $this->gitLabToken,
                'per_page' => 10000
            ],
        ]);

		// TODO add 20X status
        if ($response->getStatusCode() != 200)
        {
        	throw GitLabException("Http request failed. status code : "
        		. $response->getStatusCode() . " reason:" . $response->getReasonPhrase());
        }

        return json_decode($response->getBody());
	}

	/**
	 * performing gitlab api request
	 *
	 * @param $uri API uri
	 * @param $body body data
	 * 
	 * @return type json response
	 */
	public function send($uri, $body, $method = 'POST')
	{
		$client = new \GuzzleHttp\Client([
            'base_uri' => $this->gitHost,
            'timeout'  => 10.0,
            'verify' => false,
            ]);
		
		$postData['headers'] = ['PRIVATE-TOKEN' => $this->gitToken];

		$postData['json'] = $body;

		if ($this->debug) {
			$postData['debug'] = fopen(base_path() . '/' . 'debug.txt', 'w');
		}		

		$request = new \GuzzleHttp\Psr7\Request($method, $this->gitHost . $this->API_VERSION . $uri);

		try{
			$response = $client->send($request, $postData);
		} catch (GuzzleHttp\Exception\ClientException $e) {
			dump($response);
		    echo $e->getRequest();
		    if ($e->hasResponse()) {
		        echo $e->getResponse();
		    }
		} 

        if ($response->getStatusCode() != 200 && $response->getStatusCode() != 201)
        {
        	throw new JiraIntegrationException("Http request failed. status code : "
        		. $response->getStatusCode() . " reason:" . $response->getReasonPhrase());
        }

        return json_decode($response->getBody());
	}

}