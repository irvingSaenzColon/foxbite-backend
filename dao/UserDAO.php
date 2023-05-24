<?php
include_once '../../interface/UserCRUD.php';
include_once '../../configuration/DataBaseHelper.php';

 class UserDAO implements UserCRUD{
    public function selectAll(){
        $query = "CALL sp_basic_user_crud(?, ?, ?, ?, ?, ? ,? ,? ,?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( 0, '', '', '', '', '', '', '', '', '', '1999-04-02', null, null, 'O') );
            $result = $statement->fetch(PDO::FETCH_ASSOC);

        }
        catch(PDOException $error){
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => '',
                'message' => 'Hubo un error durante la conexión '.$error,
                'status' => 500
            );
        }
        finally{
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => $result,
                'message' => '',
                'status' => 200
            );
        }
    }
    public function selectUser(int $idParam){
        $query = "CALL sp_basic_user_crud(?, ?, ?, ?, ?, ? ,? ,? ,?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $idParam, null, null, null, null, null, null, null, null, null, '1999-04-16', null, null, 'S') );
            $result = $statement->fetch(PDO::FETCH_ASSOC);

        }
        catch(PDOException $error){
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => '',
                'message' => 'Hubo un error durante la conexión '.$error,
                'status' => 500
            );
        }
        finally{
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => $result,
                'message' => '',
                'status' => 200
            );
        }
    }
    public function selectAuthUser(string $email){
        $query = "CALL sp_basic_user_crud(?, ?, ?, ?, ?, ? ,? ,? ,?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( null, null, null, null, null, $email, null, null, null, null, null, null, null, 'A') );
            $result = $statement->fetch(PDO::FETCH_ASSOC);

        }
        catch(PDOException $error){
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => '',
                'message' => 'Hubo un error durante la conexión '.$error,
                'status' => 500
            );
        }
        finally{
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => $result,
                'message' => '',
                'status' => 200
            );
        }
    }
    public function insertUser(User $userParam){
        $query = "CALL sp_basic_user_crud(?, ?, ?, ?, ?, ? ,? ,? ,?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $userParam->getId(), $userParam->getName(), $userParam->getLastnameP(), $userParam->getLastNameM(), $userParam->getRol(), $userParam->getEmail(), $userParam->getPassword(), $userParam->getNickname(), $userParam->getStatus(), $userParam->getGender(), $userParam->getBirthdate(), $userParam->getProfileImage(), $userParam->getExtensionImage(), 'I') );
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(PDOException $error){
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => '',
                'message' => 'Hubo un error durante la conexión '.$error,
                'status' => 500
            );
        }
        finally{
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => $result,
                'message' => '',
                'status' => 200
            );
        }
    }
    public function updateUser(User $userParam, string $option){
        $query = "CALL sp_basic_user_crud(?, ?, ?, ?, ?, ? ,? ,? ,?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $userParam->getId(), $userParam->getName(), $userParam->getLastnameP(), $userParam->getLastNameM(), $userParam->getRol(), $userParam->getEmail(), $userParam->getPassword(), $userParam->getNickname(), $userParam->getStatus(), $userParam->getGender(), $userParam->getBirthdate(), $userParam->getProfileImage(), $userParam->getExtensionImage(), $option) );
            $result = $statement->fetch(PDO::FETCH_ASSOC);

        }
        catch(PDOException $error){
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => '',
                'message' => 'Hubo un error durante la conexión '.$error,
                'status' => 500
            );
        }
        finally{
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => $result,
                'message' => '',
                'status' => 200
            );
        }
    }
    public function deleteUser(User $userParam){
        $query = "CALL sp_basic_user_crud(?, ?, ?, ?, ?, ? ,? ,? ,?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $userParam->getId(), null, null, null, null, null, null, null, null, null, null, null, null, 'D') );
            $result = $statement->fetch(PDO::FETCH_ASSOC);

        }
        catch(PDOException $error){
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => '',
                'message' => 'Hubo un error durante la conexión '.$error,
                'status' => 500
            );
        }
        finally{
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => $result,
                'message' => '',
                'status' => 200
            );
        }
    }
    public function selectUserInstructors(){
        $query = "CALL sp_basic_user_crud(?, ?, ?, ?, ?, ? ,? ,? ,?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( null, null, null, null, null, null, null, null, null, null, null, null, null, 'W') );
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(PDOException $error){
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => '',
                'message' => 'Hubo un error durante la conexión '.$error,
                'status' => 500
            );
        }
        finally{
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => $result,
                'message' => '',
                'status' => 200
            );
        }
    }
    public function selectLastChapterSeen(User $user){
        $query = "CALL sp_basic_user_crud(?, ?, ?, ?, ?, ? ,? ,? ,?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $user->getId(), null, null, null, null, null, null, null, null, null, null, null, null, 'SVL') );
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(PDOException $error){
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => '',
                'message' => 'Hubo un error durante la conexión '.$error,
                'status' => 500
            );
        }
        finally{
            $connection->closeConnection();
            $con = null;

            return array(
                'body' => $result,
                'message' => '',
                'status' => 200
            );
        }
    }
 }

 ?>