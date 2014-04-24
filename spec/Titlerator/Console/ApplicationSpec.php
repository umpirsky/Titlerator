<?php

namespace spec\Titlerator\Console;

use PhpSpec\ObjectBehavior;

class ApplicationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Titlerator\Console\Application');
    }

    function it_is_console_application()
    {
        $this->shouldHaveType('Symfony\Component\Console\Application');
    }
}
