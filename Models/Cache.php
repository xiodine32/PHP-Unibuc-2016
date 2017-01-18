<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 8:34 PM
 */

namespace Models;


use App\Model;

/**
 * Class Cache
 * @property int id
 * @property string name
 * @property string value
 * @property string expires_at
 * @property-write int seconds
 * */
class Cache extends Model
{
    protected $fillable = ['name',
        'value',
    ];

    public function setSeconds($value)
    {
        $this->expires_at = date("Y-m-d H:i:s", time() + $value);
    }

}