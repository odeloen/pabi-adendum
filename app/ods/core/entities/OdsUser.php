<?php

namespace App\Ods\Core\Entities;

use App\User;

class OdsUser extends User
{
    protected $table = 'users';

    protected static $roleCollection = [
        ['id' => 0, 'name' => 'Member'],
        ['id' => 1, 'name' => 'Admin Pusat'],
        ['id' => 2, 'name' => 'Admin Cabang'],
    ];

    public static function roleAll() {
		return collect(static::$roleCollection);
    }

    public function getRoleAtributte($role){
        return collect(static::$roleCollection)
				->where('id', (int)$role)
				->first();
    }
}
