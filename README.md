# GitLab API For PHP User

## Requirements

- PHP >= 5.6.0
- Gitlab CE 6 or above
- [php JsonMapper](https://github.com/netresearch/jsonmapper)
- [phpdotenv](https://github.com/vlucas/phpdotenv)

## Installation

1. Download and Install PHP Composer.
	``` sh
	curl -sS https://getcomposer.org/installer | php
	```

2. Next, run the Composer command to install the latest version of php jira rest client.
   ``` sh
   php composer.phar require lesstif/php-gitlab-api 
   ```
    or add the following to your composer.json file.
   ```json
   {
       "require": {
           "lesstif/php-gitlab-api"
       }
   }
   ```

3. Run the composer install command.
	```sh
	$ composer install
	```

4. Now you need define your a Gitlab connection info into `.env` configuration.
	```
	GITLAB_HOST="https://your-gitlab.host.com"
	GITLAB_TOKEN="gitlab-private-token-for-api"
	```

# Usage

## Project
- [Get Project Info](#get-project-info)

## User
- [Get User list](#get-user-list)

### Get Project Info

```php
<?php
require 'vendor/autoload.php';

```

### Get User List

```php
<?php
require 'vendor/autoload.php';

```


# License

Apache V2 License

# See Also
* [Gitlab API](https://docs.gitlab.com/ce/api/README.html)
* [GitLab Web hooks](https://docs.gitlab.com/ce/user/project/integrations/webhooks.html)

