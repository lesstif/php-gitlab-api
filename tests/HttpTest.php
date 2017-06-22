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
    public function testProjectList()
    {
        $this->markTestSkipped();
        $p = new ProjectService();

        $ret = $p->getAlllProjects();

        var_dump($ret);
    }

    public function testProjectInfo()
    {
        $a = new Lesstif\GitLabApi\Project\Project();
        
        $p = new ProjectService();

        $ret = $p->viewProject('247');

        var_dump($ret);
    }

    public function testProjectOwned()
    {
        $p = new ProjectService();

        $ret = $p->ownedProjects();

        var_dump($ret);
    }
}
