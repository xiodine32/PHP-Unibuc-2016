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
 * @property string remote_addr
 * @property string request_uri
 * @property string request_method
 * @property string query_string
 * @property string http_referer
 * @property string http_user_agent
 * @property string session_id
 * @property string created_at
 */
class Statistic extends Model
{
    protected $fillable = [
        'request_method',
        'session_id',
        'query_string',
        'http_referer',
        'http_user_agent',
        'remote_addr',
        'request_uri',
        'session_id'
    ];

    public function fillFromRequest()
    {
        $array = [
            'session_id' => session_id(),
        ];
        foreach ($this->fillable as $item) {
            $strtoupper = strtoupper($item);
            if (isset($_SERVER[$strtoupper]))
                $array[$item] = $_SERVER[$strtoupper];
        }
        $this->fill($array);
    }
}