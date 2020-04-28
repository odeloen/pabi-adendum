<?php

namespace App\Ods\Elearning\Lecturer\Repositories;

use App\Ods\Elearning\Core\Entities\Categories\Category;

class CategoryRepository
{
    public function all()
    {
        $categories = Category::all();
        return $categories;
    }

    public function find(int $id)
    {
        $category = Category::find($id);
        return $category;
    }
}
