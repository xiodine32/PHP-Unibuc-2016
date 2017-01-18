<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/18/2017
 * Time: 5:35 AM
 */

namespace App;


class FileData
{
    private $maxFieldSize = 0;
    private $fields = [];
    private $currentField = [];
    private $data = "";
    private $ignoreFormat = false;

    public function __construct($data = "", $ignoreFormat = false)
    {
        $this->data = $data;
        $this->ignoreFormat = $ignoreFormat;
    }

    public function __toString()
    {
        if ($this->ignoreFormat)
            return $this->data;

        $h = fopen("php://temp", "rw+");

        foreach ($this->fields as $field) {
            for ($i = count($field); $i < $this->maxFieldSize; $i++)
                $field[] = "";
            fputcsv($h, $field);
        }

        fseek($h, 0);
        $returnValue = stream_get_contents($h);
        fclose($h);

        return $returnValue;
    }

    public function readable()
    {
        if ($this->ignoreFormat)
            return $this->data;

        $maxFieldSizes = [];
        for ($i = 0; $i < count($this->fields[0]); $i++)
            $maxFieldSizes[] = 0;
        foreach ($this->fields as $field) {
            for ($i = count($field); $i < $this->maxFieldSize; $i++)
                $field[] = "";
            for ($i = 0; $i < count($field); $i++)
                $maxFieldSizes[$i] = max($maxFieldSizes[$i], strlen($field[$i]));
        }
        $returnValue = "";
        $firstField = true;
        foreach ($this->fields as $field) {
            for ($i = count($field); $i < $this->maxFieldSize; $i++)
                $field[] = "";
            $len = 0;
            for ($i = 0; $i < count($field); $i++) {
                $str = $field[$i] . str_repeat(" ", $maxFieldSizes[$i] - strlen($field[$i])) . " | ";
                $len += strlen($str);
                $returnValue .= $str;
            }

            $returnValue = substr($returnValue, 0, -1);
            $len--;

            if ($firstField) {
                $firstField = false;
                $returnValue .= "\n" . str_repeat("=", $len);
            }
            $returnValue .= "\n";
        }

        return $returnValue;
    }

    public function format()
    {
        return $this->ignoreFormat ? "text/plain" : "text/csv";
    }

    public function extension()
    {
        return $this->ignoreFormat ? "txt" : "csv";
    }

    public function addLine($array)
    {
        foreach ($array as $item)
            $this->add($item);

        $this->nextline();
    }

    public function add($name)
    {
        $this->currentField[] = $name;
    }

    public function nextline()
    {
        $this->fields[] = $this->currentField;

        $this->maxFieldSize = max(count($this->currentField), $this->maxFieldSize);

        $this->currentField = [];
    }
}