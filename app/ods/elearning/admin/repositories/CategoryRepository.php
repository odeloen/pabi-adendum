<?php

namespace App\Ods\Elearning\Admin\Repositories;

use App\Ods\Elearning\Core\Entities\Categories\Category;

class CategoryRepository
{
    public function create(string $name) : Category
    {
        $category = new Category();
        $category->name = $name;

        return $category;
    }

    public function update(int $categoryID, string $name) : Category
    {
        $category = Category::find($categoryID);
        $category->name = $name;
        return $category;
    }

    public function all()
    {
        $categories = Category::all();
        return $categories;
    }

    public function save($category)
    {
        $category->save();
    }

    public function delete($category)
    {
        $category->delete();
    }

    public function find(int $id) : Category
    {
        $category = Category::find($id);
        return $category;
    }
}
