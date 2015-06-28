Joomlatools Platform
====================

[![Alt text for your video](http://img.youtube.com/vi/1Gt_eln1mUU/0.jpg)](http://www.youtube.com/watch?v=1Gt_eln1mUU)

Would you be willing to trade all the days from this day forward for one chance 
-- just one chance -- to come back here and tell our enemies that they 
may take our lives, but they'll never take our freedom?

Alba gu bra!


---

Joomlatools Platform is a modern Joomla stack that helps you get started with the best development tools and project 
structure.

Much of the philosophy behind the platform is inspired by the [Twelve-Factor App](http://12factor.net/) methodology 
including the [Joomla specific version](https://developer.joomlatools.com/platform).

## Features

* Better folder structure
* Dependency management with [Composer](http://getcomposer.org)
* Easy Joomla configuration with environment specific files
* Environment variables with [Dotenv](https://github.com/vlucas/phpdotenv)
* CLI extension installer with [Joomlatools Composer](http://github.com/joomlatools/joomla-composer)

Use [joomla-vagrant](https://github.com/joomlatools/joomla-vagrant) for additional features:

* Easy development environments with [Vagrant](http://www.vagrantup.com/)
* Easy server provisioning with [Puppet](https://puppetlabs.com/) (Ubuntu 14.04, PHP 5.5, MariaDB)
* One-command deploys using [Capistrano](http://capistranorb.com/)  

## Requirements

* PHP >= 5.5
* Composer - [Install](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
* Mbstring PHP Extension

## Installation

1. Clone the git repo - `git clone https://github.com/joomlatools/joomla-platform.git`
2. Run `composer install`
3. Copy `.env.example` to `.env` and update environment variables:
  * `JOOMLA_DB_NAME` - Database name
  * `JOOMLA_DB_USER` - Database user
  * `JOOMLA_DB_PASS` - Database password
  * `JOOMLA_DB_HOST` - Database host
  * `JOOMLA_ENV` - Set to environment (`development`, `staging`, `production`)
4. Set your site vhost document root to `/path/to/site/web/` 
5. Access Joomla administrator at `http://example.com/administrator`

## Deploys

There is currently one method to deploy platform sites out of the box:

* [joomla-console-capistrano](https://github.com/joomlatools/joomla-console-capistrano)

Any other deployment method can be used as well with one requirement:

`composer install` must be run as part of the deploy process.

## Documentation

* [Folder structure](https://developer.joomlatools.com/tools/platform/folder-structure)
* [Configuration files](https://developer.joomlatools.com/tools/platform/configuration)
* [Environment variables](https://developer.joomlatools.com/tools/platform/environment)
* [Composer](https://developer.joomlatools.com/tools/platform/composer)

## Contributing

Contributions are welcome from everyone. We have [contributing guidelines](CONTRIBUTING.md) to help you get started.

## Community

Keep track of development and community news.

* Follow [@joomlatools on Twitter](https://twitter.com/joomlatools)
* Read and subscribe to the [Joomlatools Blog](https://joomlatools.com/blog/)
* Subscribe to the [Joomlatools Newsletter](http://www.joomlatools.com/newsletter)
