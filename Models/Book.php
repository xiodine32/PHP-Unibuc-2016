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
 * @property int category_id
 * @property int user_id
 * @property string title
 * @property string link
 * @property string created_at
 * @property string thumbnail
 * @property Category category
 * @property User user
 */
class Book extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'link',
        'thumbnail'];

    public function getCategory()
    {
        return Category::where('id', '=', $this->category_id);
    }

    public function getUser()
    {
        return User::where('id', '=', $this->user_id);
    }
}