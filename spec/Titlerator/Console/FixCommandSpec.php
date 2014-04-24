<?php

namespace spec\Titlerator\Console;

use PhpSpec\ObjectBehavior;

class FixCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Titlerator\Console\FixCommand');
    }
}
