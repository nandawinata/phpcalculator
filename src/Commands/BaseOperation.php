<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jakmall\Recruitment\Calculator\Services\BaseOperationService;

class BaseOperation extends Command
{
    use BaseOperationService;

    protected static $fields = array();
    const ERROR_MIN_NUMBERS = "Give minimum 2 numbers";

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $numbers = $this->getInput($input);

        $this->generateNumber($numbers);
        $this->generateInputDisplay();
        $this->calculate();
        $this->generateOutputDisplay();

        $output->writeln($this->outputDisplay);
    }

    protected function getInput(InputInterface $input)
    {
        $collectedInput = array();

        foreach (static::$fields as $field) {
            $temp = $input->getArgument($field);
            
            if (is_array($temp)) {
                array_push($collectedInput, ...$temp);
            } else {
                array_push($collectedInput, $temp);
            }

        }

        if (count($collectedInput) < 2) {
            throw new \Exception(self::ERROR_MIN_NUMBERS, 1);
        }

        return $collectedInput;
    }
}
?>