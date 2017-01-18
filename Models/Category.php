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
 * @property int parent_id
 */
class Category extends Model
{
    static $required = ['name'];
    public $children = [];
    protected $fillable = ['name', 'parent_id'];
    protected $tableName = "categories";

    public static function all($order = '')
    {
        return parent::all($order . ' ORDER BY ifnull(parent_id, -1) ASC');
    }


}