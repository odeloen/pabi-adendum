<?php

namespace App\Ods\Elearning\Core\Entities\Materials\Types;

use App\Ods\Elearning\Core\Entities\Materials\Material;

class VideoMaterial implements IMaterial
{
    public function update($material, $content, $description = null){
        $material->video_path = $content['video_url'];
        $material->description = $description['video'];
    }

    public function getID(){
        return 'VideoMaterial';
    }

    public function getIcon(){
        return 'icon-file-play';
    }

    public function getView(){
        return 'video';
    }
}
