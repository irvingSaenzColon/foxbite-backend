<?php
include_once '../../model/Buy.php';

interface BuyCRUD{
    public function selectAll(Buy $buy);
    public function select(Buy $buy);
    public function insert(Buy $buy);
    public function update(Buy $buy);
    public function delete(Buy $buy);

    public function selectLastInserted(Buy $buy);
    public function selectVerifyBuy(Buy $buy);
    public function selectVerifyBuyChapters(Buy $buy);
    public function selectTotalRevenue(int $userId, $initDate, $endDate);
    public function selectGeneralSells(int $userId, string $category, int $status, $initDate, $endDate);
    public function selectTotalRevenueCourse(int $userId, int $courseId);
    public function selectSpecificSells(int $courseId);
    public function insertDetail(Buy $cart);
    public function deleteDetail(Buy $buy);
}
?>