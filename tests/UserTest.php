<?php

use Lesstif\GitLabApi\GitLabException;
use Lesstif\GitLabApi\User\User;

class PushTest extends PHPUnit_Framework_TestCase
{
	public function testDecode()
	{
		$json = '{name : value }';

		$mapper = new JsonMapper();
		$push = $mapper->map($json, new User());

		$this->assertEquals("Diaspora", $push->repository->name);
		$this->assertEquals("da1560886d4f094c3e6c9ef40349f7d38b5d27d7", $push->after);
		$this->assertEquals("fixed readme", $push->commits[1]->message);
		$this->assertEquals("GitLab dev user", $push->commits[1]->author->name);
		var_dump($push);
	}

}
