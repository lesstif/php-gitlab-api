<?php

use Lesstif\GitLabApi\GitLabException;
use Lesstif\GitLabApi\Project\Project;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
	public function testDecode()
	{
		$json = <<<EOD
[
  {
    "id": 4,
    "description": null,
    "default_branch": "master",
    "visibility": "private",
    "ssh_url_to_repo": "git@example.com:diaspora/diaspora-client.git",
    "http_url_to_repo": "http://example.com/diaspora/diaspora-client.git",
    "web_url": "http://example.com/diaspora/diaspora-client",
    "tag_list": [
      "example",
      "disapora client"
    ],
    "owner": {
      "id": 3,
      "name": "Diaspora",
      "created_at": "2013-09-30T13:46:02Z"
    },
    "name": "Diaspora Client",
    "name_with_namespace": "Diaspora / Diaspora Client",
    "path": "diaspora-client",
    "path_with_namespace": "diaspora/diaspora-client",
    "issues_enabled": true,
    "open_issues_count": 1,
    "merge_requests_enabled": true,
    "jobs_enabled": true,
    "wiki_enabled": true,
    "snippets_enabled": false,
    "container_registry_enabled": false,
    "created_at": "2013-09-30T13:46:02Z",
    "last_activity_at": "2013-09-30T13:46:02Z",
    "creator_id": 3,
    "namespace": {
      "id": 3,
      "name": "Diaspora",
      "path": "diaspora",
      "kind": "group",
      "full_path": "diaspora"
    },
    "import_status": "none",
    "archived": false,
    "avatar_url": "http://example.com/uploads/project/avatar/4/uploads/avatar.png",
    "shared_runners_enabled": true,
    "forks_count": 0,
    "star_count": 0,
    "runners_token": "b8547b1dc37721d05889db52fa2f02",
    "public_jobs": true,
    "shared_with_groups": [],
    "only_allow_merge_if_pipeline_succeeds": false,
    "only_allow_merge_if_all_discussions_are_resolved": false,
    "request_access_enabled": false,
    "approvals_before_merge": 0,
    "statistics": {
      "commit_count": 37,
      "storage_size": 1038090,
      "repository_size": 1038090,
      "lfs_objects_size": 0,
      "job_artifacts_size": 0
    }
  }
]
EOD;
		
		$mapper = new JsonMapper();
		$projects = $mapper->mapArray(
		    json_decode($json),
            new \ArrayObject(),
            '\Lesstif\GitLabApi\Project\Project'
        );

		$u = $projects[0];
		$this->assertEquals("4", $u->id);
		$this->assertEquals(null, $u->description);

		$this->assertEquals("Diaspora Client", $u->name);
		$this->assertEquals("private", $u->visibility);
	}

}
