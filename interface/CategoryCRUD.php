<?php
include_once '../../model/Category.php';

interface CategoryCRUD{
    public function selectAll();
    public function selectCategory(int $id);
    public function selectLastCategoryCreatedBy($id);
    public function selectCategoryFromUser(Category $category);
    public function insertCategory(Category $category);
    public function updateCategory(Category $category, string $option);
    public function deleteCategory(Category $category);
}
?>