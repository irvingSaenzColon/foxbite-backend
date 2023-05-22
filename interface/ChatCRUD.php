<?php
include_once '../../model/Chat.php';

interface ChatCRUD{
    public function selectAll(Chat $chat);
    public function selectChat(Chat $chat);
    public function insertChat(Chat $chat);
    public function updateChat(Chat $chat);
    public function deleteChat(Chat $chat);

    public function insertMessageChat(Chat $chat);
}

?>