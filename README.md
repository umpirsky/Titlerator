<h3 align="center">
    <a href="https://github.com/umpirsky">
        <img src="https://farm2.staticflickr.com/1709/25098526884_ae4d50465f_o_d.png" />
    </a>
</h3>
<p align="center">
  <a href="https://github.com/umpirsky/Symfony-Upgrade-Fixer">symfony upgrade fixer</a> &bull;
  <a href="https://github.com/umpirsky/Twig-Gettext-Extractor">twig gettext extractor</a> &bull;
  <a href="https://github.com/umpirsky/wisdom">wisdom</a> &bull;
  <a href="https://github.com/umpirsky/centipede">centipede</a> &bull;
  <a href="https://github.com/umpirsky/PermissionsHandler">permissions handler</a> &bull;
  <a href="https://github.com/umpirsky/Extraload">extraload</a> &bull;
  <a href="https://github.com/umpirsky/Gravatar">gravatar</a> &bull;
  <a href="https://github.com/umpirsky/locurro">locurro</a> &bull;
  <a href="https://github.com/umpirsky/country-list">country list</a> &bull;
  <a href="https://github.com/umpirsky/Transliterator">transliterator</a>
</p>

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
