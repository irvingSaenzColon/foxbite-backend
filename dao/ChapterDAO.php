<?php
include_once '../../interface/ChapterCRUD.php';
include_once '../../configuration/DataBaseHelper.php';

 class ChapterDAO implements ChapterCRUD{
    public function selectAll(Chapter $chapter){
        $query = "CALL sp_basic_chapter_actions(?, ?, ?, ?, ?, ? ,?)";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( 0, null, null, null, $chapter->getCourseId(), null, 'SA') );
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

    public function selectChapter(Chapter $chapter){
        $query = "CALL sp_basic_chapter_actions(?, ?, ?, ?, ?, ? ,?)";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $chapter->getId(), null, null, null, null, null, 'SE') );
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

    public function insertChapter(Chapter $chapter){
        $query = "CALL sp_basic_chapter_actions( ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $chapter->getId(), $chapter->getTitle(), $chapter->getDescription(), $chapter->getCost(), $chapter->getCourseId(), null, 'I') );
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

    public function updateChapter(Chapter $chapter){
        $query = "CALL sp_basic_chapter_actions( ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $chapter->getId(), $chapter->getTitle(), $chapter->getDescription(), $chapter->getCost(), $chapter->getCourseId(), null, 'U') );
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

    public function deleteChapter(Chapter $chapter){
        $query = "CALL sp_basic_chapter_actions( ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $chapter->getId(), $chapter->getTitle(), $chapter->getDescription(), $chapter->getCost(), $chapter->getCourseId(), null, 'D') );
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

    public function selectLastChaperCreatedBy(Chapter $chapter){
        $query = "CALL sp_basic_chapter_actions(?, ?, ?, ?, ?, ?, ?)";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( null, null, null, null, $chapter->getCourseId(), $chapter->getUserId(),  'SL') );
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

    public function insertVideoChapter(Chapter $chapter){
        $query = "CALL sp_bind_chapter_video(?, ?, ?, ?, ?)";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( null, $chapter->getVideoPath()['video_path'], $chapter->getVideoPath()['video_format'], $chapter->getId(),  'I') );
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

    public function insertResourceChapter(Chapter $chapter){
        $query = "CALL sp_bind_chapter_resource(?, ?, ?, ?, ?)";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( null, $chapter->getDocumentsPath()['path'], $chapter->getDocumentsPath()['format'], $chapter->getId(),  'I') );
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

    public function selectVideoFromChapter(Chapter $chapter){
        $query = "CALL sp_basic_chapter_actions(?, ?, ?, ?, ?, ?, ?)";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $chapter->getId(), null, null, null, null, $chapter->getUserId(),  'SVC') );
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

    public function selectResourcesFromChapter(Chapter $chapter){
        $query = "CALL sp_basic_chapter_actions(?, ?, ?, ?, ?, ?, ?)";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $chapter->getId(), null, null, null, null, null,  'SCR') );
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