<?php

namespace spec\Titlerator;

use PhpSpec\ObjectBehavior;

class TitleratorSpec extends ObjectBehavior
{
    /**
     * @param Transliterator\Transliterator $transliterator
     */
    function let($transliterator)
    {
        $this->beConstructedWith($transliterator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Titlerator\Titlerator');
    }

    function it_does_not_change_ascii_text_while_fixing_encoding()
    {
        $this->setText('Dobar dan.');
        $this->fixEncoding();

        $this->getText()->shouldReturn('Dobar dan.');
    }

    function it_fixes_č_letter()
    {
        $this->setText('Koja sluèajnost.');
        $this->fixEncoding();

        $this->getText()->shouldReturn('Koja slučajnost.');
    }

    function it_fixes_ć_letter()
    {
        $this->setText('Imaju koktel sa trešnjama, seæaš se?');
        $this->fixEncoding();

        $this->getText()->shouldReturn('Imaju koktel sa trešnjama, sećaš se?');
    }

    function it_uses_transliterator_for_text_transliteration($transliterator)
    {
        $this->setText('Dobar dan.');
        $transliterator->transliterate('Dobar dan.', false)->shouldBeCalled()->willReturn('Добар дан.');

        $this->transliterate();

        $this->getText()->shouldReturn('Добар дан.');
    }
}
