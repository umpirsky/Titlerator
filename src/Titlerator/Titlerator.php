<?php

namespace Titlerator;

use Transliterator\Transliterator;
use ForceUTF8\Encoding;

class Titlerator
{
    private $transliterator;
    private $text;

    public function __construct(Transliterator $transliterator, $text = '')
    {
        $this->transliterator = $transliterator;
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function fixEncoding()
    {
        $this->text = Encoding::toUTF8($this->text);

        $this->text = str_replace(
            ['æ', 'Æ', 'è', 'È', '', '', '', '', 'ð'],
            ['ć', 'Ć', 'č', 'Č', 'š', 'Š', 'ž', 'Ž', 'đ'],
            $this->text
        );

        return $this;
    }

    public function transliterate($direction = false)
    {
        $this->text = $this->transliterator->transliterate($this->text, $direction);

        $this->text = str_replace(
            ['<и>', '</и>', '<б>', '</б>'],
            ['<i>', '</i>', '<b>', '</b>'],
            $this->text
        );

        return $this;
    }
}
