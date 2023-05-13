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
    public function insertLinkChapter(Chapter $chapter);
    public function selectLastChaperCreatedBy(Chapter $chapter);
    public function selectVideoFromChapter(Chapter $chapter);
    public function selectResourcesFromChapter(Chapter $chapter);
    public function selectResourceFromChapter(Chapter $chapter);
    public function selectLinksFromChapter(Chapter $chapter);
    public function updateVideoFromChapter(Chapter $chapter);
    public function deleteChapterResource(Chapter $chapter);
    public function deleteChapterLink(Chapter $chapter);
}
?>