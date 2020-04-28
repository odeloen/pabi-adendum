<?php

namespace App\Ods\Elearning\Core\Entities\Materials\Types;

use App\Ods\Elearning\Core\Entities\Materials\Material;

class FileMaterial implements IMaterial
{
    public function update($material, $content, $description = null){
        if ($material->file_path != null && file_exists(storage_path('app/public/'.$material->file_path))){
            unlink(storage_path('app/public/'.$material->file_path));
        }

        $file = $content['file'];
        $originalFilename = $file->getClientOriginalName();
        $material->file_name = $originalFilename;

        $fileDirectory = 'Ods/elearning/materials/files/';
        $materialFilePath = $file->store('public/'.$fileDirectory);
        $tempArray = explode('/', $materialFilePath);

        $fileName = end($tempArray);
        $filePath = $fileDirectory.$fileName;
        $material->file_path = $filePath;

        $material->description = $description['file'];
    }

    public function getID(){
        return 'FileMaterial';
    }

    public function getIcon(){
        return 'icon-file-pdf';
    }

    public function getView(){
        return 'pdf';
    }
}
