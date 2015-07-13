<?php
namespace Platform;

use Symfony\Component\Console\Input\ArrayInput;
use Joomlatools\Console\Application;

class Project
{
    public static function install()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return;
        }

        $cwd  = getcwd();
        $www  = dirname($cwd);
        $site = basename($cwd);

        $arguments = array(
            'site:install',
            'site'          => $site,
            '--www'         => $www,
            '--interactive' => true
        );

        $application = new Application();
        $application->run(new ArrayInput($arguments));
    }
}