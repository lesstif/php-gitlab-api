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
		$users = $mapper->mapArray(
		    json_decode($json),
            new \ArrayObject(),
            //'\Lesstif\GitLabApi\User\User'
            Lesstif\GitLabApi\User\User::class
        );

		$u = $users[0];
		$this->assertEquals("1", $u->id);
		$this->assertEquals("john_smith", $u->username);

		$this->assertEquals("John Smith", $u->name);
		$this->assertEquals("active", $u->state);
	}

}
