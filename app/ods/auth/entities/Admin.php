<?php

namespace App\Ods\Auth\Entities;

use App\Ods\Core\Entities\OdsUser;
use App\Ods\Utils\Model\OdsModelTrait;

class Admin extends OdsUser
{
    protected $connection = 'odssql';
    protected $table = 'users';

    public static function create($id, $username, $email){
        $admin = new Admin;
        $admin->id = $id;
        $admin->username = $username;
        $admin->email = $email;
        return $admin;
    }
}
