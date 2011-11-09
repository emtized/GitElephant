<?php

/*
 * This file is part of the GitWrapper package.
 *
 * (c) Matteo Giachino <matteog@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Just for fun...
 */

namespace GitWrapper\Command;

use GitWrapper\Command\Caller;

/**
 * BaseCommand
 *
 * The base class for all the git commands wrapper
 *
 * @author Matteo Giachino <matteog@gmail.com>
 */

class BaseCommand
{
    private $commandName;
    private $commandArguments = array();
    private $commandSubject;

    private $stdOut;


    public static function create($cmd, $cwd = null, array $env = null) {
        return new static($cmd, $cwd, $env);
    }

    protected function addCommandName($commandName)
    {
        $this->commandName = $commandName;
    }

    protected function addCommandArgument($commandArgument)
    {
        $this->commandArguments[] = $commandArgument;
    }

    protected function addCommandSubject($commandSubject)
    {
        $this->commandSubject = $commandSubject;
    }

    public function getCommand()
    {
        if ($this->commandName == null) {
            throw new \InvalidParameterException("You should pass a commandName to execute a command");
        }
        
        return $this->commandName
               .' '.implode(' ', array_map('escapeshellarg', $this->commandArguments))
               .' '.$this->commandSubject;
    }

    
}
