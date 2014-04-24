<?php

namespace Titlerator\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local;
use Transliterator\Transliterator;
use Transliterator\Settings;
use Titlerator\Titlerator;

class FixCommand extends Command
{
    protected function configure()
    {
        $this->ignoreValidationErrors();

        $this
            ->setName('fix')
            ->setDefinition([
                new InputArgument('file', InputArgument::REQUIRED),
                new InputOption('transliterate', null, InputOption::VALUE_NONE),
            ])
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        $filesystem = new Filesystem(new Local('/'));

        $titlerator = new Titlerator(
            new Transliterator(Settings::LANG_SR),
            $filesystem->read($file)
        );
        $titlerator->fixEncoding();

        if ($input->getOption('transliterate')) {
            $titlerator->transliterate();
        }

        $filesystem->write($file, $titlerator->getText(), true);
    }
}
