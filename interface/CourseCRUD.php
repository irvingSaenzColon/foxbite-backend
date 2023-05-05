<?php
include_once '../../model/Course.php';
include_once '../../model/Category.php';

interface CourseCRUD{
    public function selectAll();
    public function selectCourse(int $id);
    public function insertCourse(Course $course);
    public function updateCourse(Course $course);
    public function deleteCourse(Course $course);

    public function selectCourseFromUser(Course $course);
    public function selectLastCourseCreatedBy(Course $course);
    public function bindCategoryWithCourse(int $id, Course $course, Category $category, string $option);
    public function selectCourseAdvanced($title, $category, $teacher, $beginDate, $endDate);
}
?>