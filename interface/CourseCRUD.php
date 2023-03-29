<?php
include_once '../../model/Course.php';

interface CourseCRUD{
    public function selectAll();
    public function selectCourse(int $id);
    public function selectCourseFromUser(Course $course);
    public function insertCourse(Course $course);
    public function updateCourse(Course $course, string $option);
    public function deleteCourse(Course $course);
}
?>