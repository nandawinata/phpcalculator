<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Jakmall\Recruitment\Calculator\Commands\BaseOperation;
use Symfony\Component\Console\Input\InputArgument;

class Divide extends BaseOperation
{
    protected static $defaultName = 'divide';
    protected static $fields = array('numbers');
    protected static $operator = "/";

    protected function configure()
    {
        $this->setDescription('Divide all given Numbers')
            ->addArgument(static::$fields[0], InputArgument::IS_ARRAY, 'The numbers to be divided');
    }

    protected function calculate()
    {
        if (count($this->numbers) < 2) {
            throw new \Exception(self::ERROR_MIN_NUMBERS, 1);
        }

        $result = (int) $this->numbers[0];

        for ($i = 1; $i < count($this->numbers); $i++) {
            $result /= (int) $this->numbers[$i];
        }

        $this->result = $result;

        return $this->result;
    }
}

?>