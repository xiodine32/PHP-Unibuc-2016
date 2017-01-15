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
 * @property string id
 * @property string name
 * @property string email
 * @property string password
 */
class Role extends Model
{
    static $required = ['name'];
    protected $fillable = ['name'];
}