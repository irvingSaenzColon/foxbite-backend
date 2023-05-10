<?php
include_once '../../model/Chapter.php';

interface ChapterCRUD{
    public function selectAll(Chapter $chapter);
    public function selectChapter(Chapter $chapter);
    public function insertChapter(Chapter $category);
    public function updateChapter(Chapter $category);
    public function deleteChapter(Chapter $category);

    public function insertVideoChapter(Chapter $chapter);
    public function insertResourceChapter(Chapter $chapter);
    public function selectLastChaperCreatedBy(Chapter $chapter);
    public function selectVideoFromChapter(Chapter $chapter);
    public function selectResourcesFromChapter(Chapter $chapter);
}
?>