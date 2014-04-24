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

        $this->text = str_replace(
            ['<и>', '<б>'],
            ['<i>', '<b>'],
            $this->text
        );

        return $this;
    }

    public function transliterate()
    {
        $this->text = $this->transliterator->lat2Cyr($this->text);

        return $this;
    }
}
