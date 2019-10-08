<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Jakmall\Recruitment\Calculator\Services\HistoryService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HistoryList extends Command
{
    protected static $defaultName = 'history';
    protected static $field = "commands";

    protected function configure()
    {
        $this->setName("history:list")
            ->setDescription('Show calculator history')
            ->addArgument(static::$field, InputArgument::IS_ARRAY, 'Filter the history by commands');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filter = $input->getArgument(static::$field);

        $output->writeln(HistoryService::generateHistoryTable($filter));
    }
}

?>