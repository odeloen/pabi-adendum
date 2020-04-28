<?php

namespace App\Ods\Auth\Entities\User;

use App\Ods\Core\Entities\OdsUser;
use App\Ods\Utils\Model\OdsModelTrait;

class BranchAdmin extends OdsUser
{
    protected $table = 'users';
}
