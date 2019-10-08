<?php

namespace Jakmall\Recruitment\Calculator\Services;

use Jakmall\Recruitment\Calculator\Models\Operations;

class HistoryService {
    public static function store($command, $description, $result, $output) {
        $data = new Operations($command, $description, $result, $output);

        return $data->store();
    }

    public static function truncate() {
        Operations::truncate();

        return "History cleared!";
    }

    public static function generateHistoryTable($filter = array()) {
        $rows = Operations::filter($filter);

        if (!$rows) {
            return "History is empty";
        }

        $header = "+---+----------+------------------------------+----------+------------------------------+------------------------------+\n";
        $format = "|%-3s|%-10s|%-30s|%-10s|%-30s|%-30s|\n";

        $result = $header;
        $result .= sprintf($format, "No", "Command", "Description", "Result", "Output", "Time");
        $result .= $header;

        foreach ($rows as $key => $row) {
            $result .= sprintf($format, ($key+1), ...$row);
        }

        $result .= $header;

        return $result;
    }

}

?>