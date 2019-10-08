<?php

namespace Jakmall\Recruitment\Calculator\Commands;

use Jakmall\Recruitment\Calculator\Commands\BaseOperation;
use Symfony\Component\Console\Input\InputArgument;

class Pow extends BaseOperation
{
    protected static $defaultName = 'pow';
    protected static $fields = array('base', 'exp');
    protected static $operator = "^";

    protected function configure()
    {
        $this->setDescription('Exponent the given Numbers')
            ->addArgument(static::$fields[0], InputArgument::REQUIRED, 'The base number')
            ->addArgument(static::$fields[1], InputArgument::REQUIRED, 'The exponent number');
    }

    protected function calculate()
    {
        if (count($this->numbers) < 2) {
            throw new \Exception(self::ERROR_MIN_NUMBERS, 1);
        }
        
        $this->result = pow((int) $this->numbers[0], (int) $this->numbers[1]);

        return $this->result;
    }
}

?>