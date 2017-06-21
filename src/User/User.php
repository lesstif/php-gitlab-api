<?php

namespace Lesstif\GitLabApi\User;

use Lesstif\GitLabApi\ClassSerialize;

/**
 * Description of User.
 *
 */
class User implements \JsonSerializable
{
    use ClassSerialize;

    /** @var int */
    public $id;

    /** @var  string */
    public $username;

    /** @var string */
    public $name;

    /** @var string */
    public $state;

    /** @var string */
    public $avatar_url;

    /** @var string */
    public $web_url;

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }
}
