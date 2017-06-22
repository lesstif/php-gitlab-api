<?php

use Lesstif\GitLabApi\HttpClient;
use Lesstif\GitLabApi\Project\ProjectService;
use PHPUnit\Framework\TestCase;

class HttpTest extends TestCase
{
    protected $baseUrl = 'http://localhost:9000/';

    protected $http = null;

    protected  function setUp()
    {
        $this->http = new HttpClient();
    }

    protected  function tearDown()
    {
        $this->http = null;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $p = new ProjectService();

        $ret = $p->getAlllProjects();

        //$this->assertEquals($this->http, null);

        var_dump($ret);
    }

}
