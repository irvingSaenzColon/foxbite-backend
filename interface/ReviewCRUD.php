<?php
include_once '../../model/Review.php';

interface ReviewCRUD{
    public function selectAll(Review $review);
    public function select(Review $review);
    public function insert(Review $review);
    public function update(Review $review);
    public function delete(Review $review);
    public function deleteLogic(Review $review);


    public function selectUserReview(Review $review);
}
?>