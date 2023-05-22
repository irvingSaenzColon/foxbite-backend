<?php

include_once '../../interface/CartCRUD.php';
include_once '../../configuration/DataBaseHelper.php';

 class CartDAO implements CartCRUD{
    public function selectAll(Cart $cart){
        $query = "CALL sp_basic_cart_actions( ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $cart->getId(), $cart->getTotal(), $cart->getOwner(), $cart->getDetailId(), $cart->getCourseId(), $cart->getChapterId(), $cart->getDetailCost(), 'SE') );
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

    public function select(Cart $cart){
        $query = "CALL sp_basic_cart_actions( ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $cart->getId(), $cart->getTotal(), $cart->getOwner(), $cart->getDetailId(), $cart->getCourseId(), $cart->getChapterId(), $cart->getDetailCost(), 'LA') );
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

    public function insert(Cart $cart){
        $query = "CALL sp_basic_cart_actions( ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $cart->getId(), $cart->getTotal(), $cart->getOwner(), $cart->getDetailId(), $cart->getCourseId(), $cart->getChapterId(), $cart->getDetailCost(), 'I') );
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

    public function update(Cart $cart){
        $query = "CALL sp_basic_cart_actions( ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $cart->getId(), $cart->getTotal(), $cart->getOwner(), $cart->getDetailId(), $cart->getCourseId(), $cart->getChapterId(), $cart->getDetailCost(), 'U') );
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

    public function delete(Cart $cart){
        $query = "CALL sp_basic_cart_actions( ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $cart->getId(), $cart->getTotal(), $cart->getOwner(), $cart->getDetailId(), $cart->getCourseId(), $cart->getChapterId(), $cart->getDetailCost(), 'D') );
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

    public function insertDetail(Cart $cart){
        $query = "CALL sp_basic_cart_actions( ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $cart->getId(), $cart->getTotal(), $cart->getOwner(), $cart->getDetailId(), $cart->getCourseId(), $cart->getChapterId(), $cart->getDetailCost(), 'ID') );
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