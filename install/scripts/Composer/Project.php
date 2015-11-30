<?php
/**
 * Joomlatools Platform - http://developer.joomlatools.org/platform
 *
 * @copyright	Copyright (C) 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/joomlatools/joomlatools-platform for the canonical source repository
 */

namespace Composer;

use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

use Joomlatools\Console\Application;

class Project
{
    public static function install()
    {
        $output = new ConsoleOutput();

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
        {
            $output->writeln("<info>Sorry, automated installation is not yet supported on Windows!</info>");
            $output->writeln("Please refer to the documentation for alternative installation methods: http://developer.joomlatools.com/platform/getting-started.html");

            return;
        }

        $input = new ArgvInput();
        if ($input->hasParameterOption(array('--no-interaction', '-n'))) {
            return;
        }

        $cwd  = getcwd();
        $www  = dirname($cwd);
        $site = basename($cwd);

        $arguments = array(
            'site:install',
            'site'          => $site,
            '--www'         => $www,
            '--interactive' => true,
            '--mysql_db_prefix' => ''
        );

        $output->writeln("<info>Welcome to the Joomlatools Platform installer!</info>");
        $output->writeln("Fill in the following details to configure your new application.");

        $application = new Application();
        $application->run(new ArrayInput($arguments));
    }
}