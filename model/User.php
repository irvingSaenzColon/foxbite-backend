<?php

class User{
    private $id = '';
    private $name = '';
    private $lastnameP = '';
    private $lastnameM = '';
    private $rol = '';
    private $email = '';
    private $password = '';
    private $nickname = '';
    private $status = '';
    private $gender = '';
    private $birthdate = '';
    private $profileImage = null;
    private $extensionImage = '';

    public function __construct($idParam, $nameParam, $lastnamePParam, $lastnameMParam, $rolParam, $emailParam, $passwordParam, $nicknameParam, $statusParam, $genderParam, $birthdateParam, $profileImageParam, $extensionImageParam)
    {
        $this->id = $idParam;
        $this->name = $nameParam;
        $this->lastnameP = $lastnamePParam;
        $this->lastnameM = $lastnameMParam;
        $this->rol = $rolParam;
        $this->email = $emailParam;
        $this->password = $passwordParam;
        $this->nickname = $nicknameParam;
        $this->status = $statusParam;
        $this->gender = $genderParam;
        $this->birthdate = $birthdateParam;
        $this->profileImage = $profileImageParam;
        $this->extensionImage = $extensionImageParam;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($idParam){
        $this->id = $idParam;
    }

    public function getName(){
        return $this->name;
    }
    public function setName($nameParam){
        $this->name = $nameParam;
    }

    public function getLastnameP(){
        return $this->lastnameP;
    }
    public function setLastnameP($lastnameParam){
        $this->lastnameP = $lastnameParam;
    }

    public function getLastNameM(){
        return $this->lastnameM;
    }
    public function setLastNameM($lastnameParam){
        $this->lastnameM = $lastnameParam;
    }

    public function getRol(){
        return $this->rol;
    }
    public function setRol($rolParam){
        $this->rol = $rolParam;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($emailParam){
        $this->email = $emailParam;
    }

    public function getPassword(){
        return $this->password;
    }
    public function setPassword($passwordParam){
        $this->password = $passwordParam;
    }

    public function getNickname(){
        return $this->nickname;
    }
    public function setNickname($nicknameParam){
        $this->nickname = $nicknameParam;
    }

    public function getStatus(){
        return $this->status;
    }
    public function setStatus($statusParam){
        $this->status = $statusParam;
    }

    public function getGender(){
        return $this->gender;
    }
    public function setGender($genderParam){
        $this->gender = $genderParam;
    }

    public function getBirthdate(){
        return $this->birthdate;
    }
    public function setBirthdate($birthdateParam){
        $this->birthdate = $birthdateParam;
    }

    public function getProfileImage(){
        return $this->profileImage;
    }
    public function setProfileImage($profileImageParam){
        $this->profileImage = $profileImageParam;
    }

    public function getExtensionImage(){
        return $this->extensionImage;
    }
    public function setExtensionImage($extensionImageParam){
        $this->extensionImage = $extensionImageParam;
    }

    public function jsonSerialize(){
        return json_encode(get_object_vars($this), JSON_UNESCAPED_SLASHES);
    }
}
?>