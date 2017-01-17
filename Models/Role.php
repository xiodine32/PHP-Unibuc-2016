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
 * @property int id
 * @property string name
 */
class Role extends Model
{
    protected $fillable = ['name'];
}