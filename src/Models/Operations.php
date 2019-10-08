<?php

namespace Jakmall\Recruitment\Calculator\Models;

class Operations {
    const DELIMITER_COLUMN = ",";
    const DELIMITER_ROW = "\n";

    private static $filepath = "./src/Models/operations.txt";
    private $command, $description, $result, $output, $time;
    
    public function __construct($command, $description, $result, $output)
    {
        $this->command = $command;
        $this->description = $description;
        $this->result = $result;
        $this->output = $output;
    }

    public function store()
    {
        $this->time = date("Y-m-d H:i:s");
        
        $data = $this->command.self::DELIMITER_COLUMN.$this->description.self::DELIMITER_COLUMN.$this->result.self::DELIMITER_COLUMN.$this->output.self::DELIMITER_COLUMN.$this->time;

        $savedData = self::checkFile();

        if ($savedData) {
            $data = self::DELIMITER_ROW.$data;
        }

        file_put_contents(static::$filepath, $data, FILE_APPEND);

        return $this;
    }

    public static function checkFile() {
        if (!file_exists(static::$filepath)) {
            file_put_contents(static::$filepath, "");
        }

        $data = file_get_contents(static::$filepath);

        return $data;
    }

    public static function filter($filter = array())
    {
        $result = array();

        $filter = array_map("strtolower", $filter);

        $data = self::checkFile();

        if (!$data) {
            return $result;
        }

        $rows = explode(self::DELIMITER_ROW, $data);

        foreach ($rows as $row) {
            if (!$row) {
                continue;
            }

            $column = explode(self::DELIMITER_COLUMN, $row);

            if (!$filter || (isset($column[0]) && in_array(strtolower($column[0]), $filter))) {
                array_push($result, $column);
            }
        }

        return $result; 
    }

    public static function truncate()
    {
        file_put_contents(static::$filepath, "");
    }
}

?>