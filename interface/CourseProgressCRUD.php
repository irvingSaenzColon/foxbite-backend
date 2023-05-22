<?php
include_once '../../model/CourseProgress.php';

interface CourseProgressCRUD{
    public function selectAll(CourseProgress $courseProgress);
    public function select(CourseProgress $courseProgress);
    public function insert(CourseProgress $courseProgress);
    public function update(CourseProgress $courseProgress);
    public function delete(CourseProgress $courseProgress);

    public function updateDetail(CourseProgress $courseProgress);
    public function selectLastChapterSeen(CourseProgress $courseProgress);
    public function updateDiplomaFinished(CourseProgress $courseProgress);

    public function selectUserProgress(CourseProgress $courseProgress, $visible, $category, $dateInit, $dateEnd, $finished);
}
?>