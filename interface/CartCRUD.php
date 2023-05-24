<?php
include_once '../../model/Cart.php';

interface CartCRUD{
    public function selectAll(Cart $cart);
    public function select(Cart $cart);
    public function insert(Cart $cart);
    public function update(Cart $cart);
    public function delete(Cart $cart);

    public function insertDetail(Cart $cart);
    public function deleteDetail(Cart $cart);
    public function clearDetail(Cart $cart);
    public function selectCartItemsBuy(Cart $cart);
}
?>