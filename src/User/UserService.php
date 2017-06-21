<?php
namespace Lesstif\GitLabApi\User;

use Lesstif\GitLabApi\HttpClient;

/**
 * process gitlab user API.
 *
 * @package default
 */
class UserService extends HttpClient
{
	private $userList = 'users.json';

    /**
     * fetch users list from gitlab.
     *
     * @return type
     */
    public function getAllUsers($queryParam = [])
    {
        return $this->request('users');
    }

    /**
     * get a single user.
     * @param type $id gitlab userid(int)
     * @return type
     */
    private function get($id)
    {
        $client = new HttpClient();

        $u = $client->get($id);

        $user = [
        	'name' => $u->name,
        	// username is same jira user id
        	'username' => $u->username,
        	'state' => $u->state,
        	];

        return $user;
    }

    //
    public function createUserList()
    {
        // fetch users list from gitlab and create file.
    	$client = new HttpClient();
        $body = $client->getAllUsers();

        $users = [] ;
        foreach($body as $u)
        {
            $users[$u->id] = [
                'name' => $u->name,
                // username is same jira user id
                'username' => $u->username,
                'state' => $u->state,
                ];
        }

        \Storage::put($this->userList, json_encode($users, JSON_PRETTY_PRINT));
        return $users;
    }

    /**
     * load gitlab user data from file.
     *
     * @return type user list(json encoding)
     */
    public function loadGitLabUser()
    {
        if (\Storage::has($this->userList))
        {
            $users = \Storage::read($this->userList);
            return json_decode($users, true);
        }

        // if file not exist, create empty list.
        return [];
    }
}
