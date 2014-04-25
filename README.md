Titlerator [![Build Status](https://travis-ci.org/umpirsky/Titlerator.svg?branch=master)](https://travis-ci.org/umpirsky/Titlerator)
==========

Convert subtitles to utf-8 encoding.

## Web interface

http://titlovi.umpirsky.com

## Command line

```
$ ./bin/titlerator file.sub
```

## Code

```php
$titlerator = new Titlerator(
    new Transliterator(Settings::LANG_SR),
    file_get_contents('file.sub')
);
$titlerator->fixEncoding();
$titlerator->getText();
```
