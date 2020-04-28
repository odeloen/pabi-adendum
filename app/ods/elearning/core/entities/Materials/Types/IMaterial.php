<?php

namespace App\Ods\Elearning\Core\Entities\Materials\Types;

interface IMaterial
{
    public function getID();
    public function getIcon();
    public function getView();

    public function update($material, $content, $description);
}
