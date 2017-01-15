<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 8:34 PM
 */

namespace Models;


use App\Database;
use App\Model;

/**
 * @property string id
 * @property string name
 * @property string email
 * @property string password
 */
class User extends Model
{
    static $required = ['name', 'email', 'password'];
    protected $fillable = ['name', 'email', 'password'];

    public function hasRole($role)
    {
        foreach ($this->roles() as $item) {
            if ($item->name === $role)
                return true;
        }
        return false;
    }

    public function roles($asObjects = true)
    {
        $result = Database::singleton()->getAll("SELECT * FROM roles WHERE id IN (SELECT role_id FROM `userroles` WHERE user_id = ?)", [$this->id]);
        $return = [];

        foreach ($result as $item) {
            $role = new Role($item);
            $return[] = $asObjects ? $role : $role->name;
        }

        return $return;
    }

    public function setPassword($password)
    {
        // overriding default setter with encryption.
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setRoles($roles)
    {
        $original = $this->roles();

        $add = [];
        foreach ($roles as $role) {
            $found = false;
            foreach ($original as $roleItem) {
                if ($roleItem->name === $role) {
                    $found = true;
                    break;
                }
            }
            if (!$found)
                $add[] = $role;
        }

        $delete = [];
        foreach ($original as $roleItem) {
            if (!in_array($roleItem->name, $roles))
                $delete[] = $roleItem;
        }

        $deleteP = Database::singleton()->prepare("DELETE FROM userroles WHERE user_id = ? AND role_id = ?");
        foreach ($delete as $item) {
            $deleteP->execute([$this->id, $item->id]);
        }

        $insertP = Database::singleton()->prepare("INSERT INTO userroles (user_id, role_id) VALUES (?,(SELECT id FROM roles WHERE name = ?))");
        foreach ($add as $item) {
            $insertP->execute([$this->id, $item]);
        }

    }

}