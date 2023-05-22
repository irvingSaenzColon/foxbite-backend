<?php
include_once '../../interface/ReviewCRUD.php';
include_once '../../configuration/DataBaseHelper.php';

 class ReviewDAO implements ReviewCRUD{
    public function selectAll(Review $review){
        $query = "CALL sp_basic_review_actions(?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $review->getId(), $review->getComment(), $review->getScore(), $review->getBy(), $review->getBelongs(), 'SA') );
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
    public function select(Review $review){
        $query = "CALL sp_basic_review_actions(?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $review->getId(), $review->getComment(), $review->getScore(), $review->getBy(), $review->getBelongs(), 'SE') );
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

    public function insert(Review $review){
        $query = "CALL sp_basic_review_actions(?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $review->getId(), $review->getComment(), $review->getScore(), $review->getBy(), $review->getBelongs(), 'I') );
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
    public function update(Review $review){
        $query = "CALL sp_basic_review_actions(?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $review->getId(), $review->getComment(), $review->getScore(), $review->getBy(), $review->getBelongs(), 'U') );
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
    public function delete(Review $review){
        $query = "CALL sp_basic_review_actions(?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $review->getId(), $review->getComment(), $review->getScore(), $review->getBy(), $review->getBelongs(), 'D') );
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
    public function deleteLogic(Review $review){
        $query = "CALL sp_basic_review_actions(?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $review->getId(), $review->getComment(), $review->getScore(), $review->getBy(), $review->getBelongs(), 'DL') );
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

    public function selectUserReview(Review $review){
        $query = "CALL sp_basic_review_actions(?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $review->getId(), $review->getComment(), $review->getScore(), $review->getBy(), $review->getBelongs(), 'SUR') );
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