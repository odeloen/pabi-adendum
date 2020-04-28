<?php

namespace App\Ods\Elearning\Core\Entities\Materials\Types;

use App\Ods\Elearning\Core\Config\Naming;

class MaterialTypeService
{
    public static function all(){
        $types = [
            new FileMaterial(),
            new PostMaterial(),
            new VideoMaterial(),
        ];

        return $types;
    }

    public static function getMaterialType($material){
        $typeName = Naming::getNamespace().'Entities\Materials\Types\\'.$material->type;
        $type = new $typeName();
        return $type;
    }
}
