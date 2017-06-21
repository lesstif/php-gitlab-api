<?php

namespace Lesstif\GitLabApi\Project;

use Lesstif\GitLabApi\ClassSerialize;

class Project
{
    use ClassSerialize;

    /** @var  integer */
    public $id;

    /** @var null|string */
    public $description;

    /** @var  string */
    public $default_branch;

    /** @var  string */
    public $visibility;

    /** @var  string */
    public $ssh_url_to_repo;

    /** @var  string */
    public $http_url_to_repo;

    /** @var  string */
    public $web_url;

    /** @var array */
    public $tag_list;

    /** @var  array */
    public $owner;

    /** @var  string */
    public $name;

    /** @var  string */
    public $name_with_namespace;

    /** @var  string */
    public $path;

    /** @var  string */
    public $path_with_namespace;

    /** @var boolean */
    public $issues_enabled;

    /** @var integer */
    public $open_issues_count;

    /** @var boolean */
    public $merge_requests_enabled;
}
