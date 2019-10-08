<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Jakmall\Recruitment\Calculator\Services\HistoryService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HistoryClear extends Command
{
    protected static $defaultName = 'history';

    protected function configure()
    {
        $this->setName("history:clear")
            ->setDescription('Clear saved history');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(HistoryService::truncate());
    }
}

?>