<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 8:34 PM
 */

namespace App;


class Model
{
    protected $tableName = null;
    protected $fillable = [];
    protected $primary = 'id';

    private $retrieved;
    private $fields;

    private $modified;
    private $add;
    private $update;
    private $setExists = [];

    function __construct($fields = [])
    {
        $this->modified = false;
        $this->retrieved = count($fields) !== 0;
        $this->add = [];
        $this->update = [];
        $this->fields = $fields;
    }

    /**
     * @param $id
     * @return static
     */
    public static function find($id)
    {
        return static::where('id', '=', $id);
    }

    public static function where($key, $operator, $value)
    {
        $table = (new static)->tableName();
        $result = Database::singleton()->get("SELECT * FROM {$table} WHERE {$key} {$operator} ?", [$value]);
        $return = new static($result);
        $return->retrieved = true;
        $return->modified = false;
        return $return;
    }

    private function tableName()
    {
        if ($this->tableName !== null)
            return $this->tableName;

        $name = get_class($this);
        $pos = strrpos($name, '\\');
        if ($pos !== false)
            $name = substr($name, $pos + 1);
        return $this->lowercase($name) . "s";
    }

    private function lowercase($name)
    {
        $result = "";
        if (!empty($name))
            $name[0] = strtolower($name[0]);
        for ($i = 0; $i < strlen($name); $i++) {
            $strtolower = strtolower($name[$i]);
            if ($strtolower === $name[$i]) {
                $result .= $name[$i];
                continue;
            }
            $result .= "_{$strtolower}";
        }
        return $result;
    }

    public static function all($order = '')
    {
        $table = (new static)->tableName();
        $result = Database::singleton()->getAll("SELECT * FROM {$table} {$order}");
        $returnValues = [];
        foreach ($result as $item) {
            $item = new static($item);
            $item->retrieved = true;
            $item->modified = false;

            $returnValues[] = $item;
        }
        return $returnValues;
    }

    public function fill($array)
    {
        foreach ($this->fillable as $item) {
            if (isset($array[$item]) && $this->$item !== $array[$item])
                $this->$item = $array[$item];
        }
    }

    public function fillEmpty($array)
    {
        foreach ($this->fillable as $item) {
            if (!empty($array[$item]) && $this->$item !== $array[$item])
                $this->$item = $array[$item];
        }
    }

    function __get($name)
    {
        if (empty($this->fields[$name]))
            return null;

        return $this->fields[$name];
    }

    function __set($name, $value)
    {
        // try to call setter
        $method_name = "set" . ucfirst($name);
        if (empty($this->setExists[$name]) && method_exists($this, $method_name)) {
            $this->setExists[$name] = true;
            $this->$method_name($value);
            unset($this->setExists[$name]);
            return;
        }

        // if field already exists
        if (isset($this->fields[$name]) && empty($this->add[$name])) {
            $this->modified = true;
            $this->update[$name] = $value;
            $this->fields[$name] = $value;
            return;
        }

        // add new field
        $this->modified = true;
        $this->add[$name] = $value;
        $this->fields[$name] = $value;
    }

    function save()
    {
        if ($this->retrieved) {
            if ($this->modified)
                $this->saveUpdate();
            return;
        }

        $this->saveNew();
    }

    private function saveUpdate()
    {
        $table = $this->tableName();
        $updates = [];
        $assoc = [];
        foreach ($this->update as $key => $value) {
            $updates[] = "`{$key}` = ?";
            $assoc[] = $value;
        }
        $assoc[] = $this->fields[$this->primary];
        $sets = join(", ", $updates);
        Database::singleton()->query("UPDATE {$table} SET {$sets} WHERE `{$this->primary}` = ?", $assoc);
        $this->retrieved = true;
        $this->modified = false;
    }

    private function saveNew()
    {
        $table = $this->tableName();
        $sets = [];
        $items = [];
        $assoc = [];
        foreach ($this->fields as $key => $value) {
            $sets[] = "`{$key}`";
            $items[] = "?";
            $assoc[] = $value;
        }
        $sets = join(', ', $sets);
        $items = join(', ', $items);
        Database::singleton()->query("INSERT INTO {$table} ({$sets}) VALUES ({$items})", $assoc);
        $this->fields[$this->primary] = Database::singleton()->lastInsertId();
        $this->retrieved = true;
        $this->modified = false;
    }

    function delete()
    {
        if (!$this->retrieved)
            return;

        $table = $this->tableName();

        $assoc[] = $this->fields[$this->primary];
        Database::singleton()->query("DELETE FROM {$table} WHERE `{$this->primary}` = ?", $assoc);
    }

}