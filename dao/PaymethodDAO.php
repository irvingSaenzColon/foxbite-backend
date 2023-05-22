<?php

include_once '../../interface/PaymethodCRUD.php';
include_once '../../configuration/DataBaseHelper.php';

 class PaymethodDAO implements PaymethodCRUD{
    public function selectAll(Paymethod $paymethod){
        $query = "CALL sp_basic_paym_actions( ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $paymethod->getId(), $paymethod->getNumber(), $paymethod->getExpires(), $paymethod->getZipcode(), $paymethod->getType(), $paymethod->getOwner(), $paymethod->getBank(), $paymethod->getBelongs(), 'SU') );
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

    public function selectPaymethod(Paymethod $paymethod){
        $query = "CALL sp_basic_paym_actions( ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $paymethod->getId(), $paymethod->getNumber(), $paymethod->getExpires(), $paymethod->getZipcode(), $paymethod->getType(), $paymethod->getOwner(), $paymethod->getBank(), $paymethod->getBelongs(), 'SE') );
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

    public function insertPaymethod(Paymethod $paymethod){
        $query = "CALL sp_basic_paym_actions( ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $paymethod->getId(), $paymethod->getNumber(), $paymethod->getExpires(), $paymethod->getZipcode(), $paymethod->getType(), $paymethod->getOwner(), $paymethod->getBank(), $paymethod->getBelongs(), 'I') );
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

    public function updatePaymethod(Paymethod $paymethod){
        $query = "CALL sp_basic_paym_actions( ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $paymethod->getId(), $paymethod->getNumber(), $paymethod->getExpires(), $paymethod->getZipcode(), $paymethod->getType(), $paymethod->getOwner(), $paymethod->getBank(), $paymethod->getBelongs(), 'U') );
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

    public function deletePaymethod(Paymethod $paymethod){
        $query = "CALL sp_basic_paym_actions( ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $paymethod->getId(), $paymethod->getNumber(), $paymethod->getExpires(), $paymethod->getZipcode(), $paymethod->getType(), $paymethod->getOwner(), $paymethod->getBank(), $paymethod->getBelongs(), 'D') );
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

    public function selectLastPaymethod(Paymethod $paymethod){
        $query = "CALL sp_basic_paym_actions( ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $paymethod->getId(), $paymethod->getNumber(), $paymethod->getExpires(), $paymethod->getZipcode(), $paymethod->getType(), $paymethod->getOwner(), $paymethod->getBank(), $paymethod->getBelongs(), 'SLP') );
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

 }