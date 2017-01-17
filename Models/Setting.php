<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/17/2017
 * Time: 9:46 PM
 */

namespace Models;


use App\Model;


/**
 * Class Setting
 * @property int id
 * @property string name
 * @property string value
 */
class Setting extends Model
{
    public function getJson()
    {
        if ($this->value == null) {
            $this->setJson(false);
            return $this->getJson();
        }
        return json_decode($this->value, true);
    }

    public function setJson($value)
    {
        $this->value = json_encode($value);
    }
}