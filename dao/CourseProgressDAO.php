<?php
include_once '../../interface/CourseProgressCRUD.php';
include_once '../../configuration/DataBaseHelper.php';

 class CourseProgressDAO implements CourseProgressCRUD{
    public function selectAll(CourseProgress $courseProgress){
        $query = "CALL sp_basic_diploma_progress_actions(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $courseProgress->getId(), $courseProgress->getSeen(), $courseProgress->getTime(), $courseProgress->getCourseId(), $courseProgress->getChapterId(), $courseProgress->getUserId(), 'SA') );
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
    
    public function select(CourseProgress $courseProgress){
        $query = "CALL sp_basic_diploma_progress_actions(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $courseProgress->getId(), $courseProgress->getSeen(), $courseProgress->getTime(), $courseProgress->getCourseId(), $courseProgress->getChapterId(), $courseProgress->getUserId(), 'SE') );
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

    public function insert(CourseProgress $courseProgress){
        $query = "CALL sp_basic_diploma_progress_actions(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $courseProgress->getId(), $courseProgress->getSeen(), $courseProgress->getTime(), $courseProgress->getCourseId(), $courseProgress->getChapterId(), $courseProgress->getUserId(), 'I') );
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

    public function update(CourseProgress $courseProgress){
        $query = "CALL sp_basic_diploma_progress_actions(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $courseProgress->getId(), $courseProgress->getSeen(), $courseProgress->getTime(), $courseProgress->getCourseId(), $courseProgress->getChapterId(), $courseProgress->getUserId(), 'U') );
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

    public function delete(CourseProgress $courseProgress){
        $query = "CALL sp_basic_diploma_progress_actions(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $courseProgress->getId(), $courseProgress->getSeen(), $courseProgress->getTime(), $courseProgress->getCourseId(), $courseProgress->getChapterId(), $courseProgress->getUserId(), 'D') );
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

    public function updateDetail(CourseProgress $courseProgress){
        $query = "CALL sp_basic_diploma_progress_actions(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $courseProgress->getId(), $courseProgress->getSeen(), $courseProgress->getTime(), $courseProgress->getCourseId(), $courseProgress->getChapterId(), $courseProgress->getUserId(), 'UD') );
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

    public function selectLastChapterSeen(CourseProgress $courseProgress){
        $query = "CALL sp_basic_diploma_progress_actions(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $courseProgress->getId(), $courseProgress->getSeen(), $courseProgress->getTime(), $courseProgress->getCourseId(), $courseProgress->getChapterId(), $courseProgress->getUserId(), 'SLC') );
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

    public function updateDiplomaFinished(CourseProgress $courseProgress){
        $query = "CALL sp_basic_diploma_progress_actions(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $courseProgress->getId(), $courseProgress->getSeen(), $courseProgress->getTime(), $courseProgress->getCourseId(), $courseProgress->getChapterId(), $courseProgress->getUserId(), 'UF') );
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

    public function selectUserProgress(CourseProgress $courseProgress, $visible, $category, $dateInit, $dateEnd, $finished){
        $query = "CALL sp_progress(?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $courseProgress->getUserId(), $visible, $category, $dateInit, $dateEnd, $finished) );
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