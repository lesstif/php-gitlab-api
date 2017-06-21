<?php

use Lesstif\GitLabApi\GitLabException;
use Lesstif\GitLabApi\User\User;

class PushTest extends PHPUnit_Framework_TestCase
{
	public function testDecode()
	{
		$json = <<<EOD
[
  {
      "id": 1,
    "username": "john_smith",
    "name": "John Smith",
    "state": "active",
    "avatar_url": "http://localhost:3000/uploads/user/avatar/1/cd8.jpeg",
    "web_url": "http://localhost:3000/john_smith"
  },
  {
      "id": 2,
    "username": "jack_smith",
    "name": "Jack Smith",
    "state": "blocked",
    "avatar_url": "http://gravatar.com/../e32131cd8.jpeg",
    "web_url": "http://localhost:3000/jack_smith"
  }
]
EOD;
		
		$mapper = new JsonMapper();
		$push = $mapper->map(json_decode($json, false), new User());

		$this->assertEquals("Diaspora", $push->repository->name);
		$this->assertEquals("da1560886d4f094c3e6c9ef40349f7d38b5d27d7", $push->after);
		$this->assertEquals("fixed readme", $push->commits[1]->message);
		$this->assertEquals("GitLab dev user", $push->commits[1]->author->name);
		var_dump($push);
	}

}
