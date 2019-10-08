<?php

namespace Jakmall\Recruitment\Calculator\Services;

trait BaseOperationService
{
    protected static $operator;
    protected $numbers = array();
    protected $inputDisplay, $result, $outputDisplay;

    protected function generateNumber($numbers = array())
    {
        $this->numbers = $numbers;

        return $this->numbers;
    }

    protected function generateInputDisplay()
    {
        $inputDisplay = "";

        foreach ($this->numbers as $key => $number) {
            $inputDisplay .= $number;

            if ($key < (count($this->numbers)-1)) {
                $inputDisplay .= " ".static::$operator." ";
            }
        }

        $this->inputDisplay = $inputDisplay;

        return $this->inputDisplay;
    }

    protected function calculate()
    {
    }

    protected function generateOutputDisplay()
    {
        $this->outputDisplay = $this->inputDisplay." = ".$this->result;

        return $this->outputDisplay;
    }
}

?>