<?php
include_once '../../model/User.php';

interface UserCRUD{
    public function selectAll();
    public function selectUser(int $idParam);
    public function selectAuthUser(string $email);
    public function insertUser(User $userParam);
    public function updateUser(User $userParam);
    public function deleteUser(User $userParam);
}
?>