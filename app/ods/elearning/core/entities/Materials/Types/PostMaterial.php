<?php

namespace App\Ods\Elearning\Core\Entities\Materials\Types;

use App\Ods\Elearning\Core\Entities\Materials\Material;

class PostMaterial implements IMaterial
{
    public function update($material, $content, $description = null){
        $material->post_content = $content['editor'];
    }

    public function getID(){
        return 'PostMaterial';
    }

    public function getIcon(){
        return 'icon-file-text2';
    }

    public function getView(){
        return 'post';
    }
}
