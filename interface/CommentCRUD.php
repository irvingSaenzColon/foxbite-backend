<?php
include_once '../../model/Comment.php';

interface CommentCRUD{
    public function selectAll(Comment $comment);
    public function selectComment(Comment $comment);
    public function insertComment(Comment $comment);
    public function updateComment(Comment $comment);
    public function deleteComment(Comment $comment);

    public function selectLastCommentByUser(Comment $comment);
}
