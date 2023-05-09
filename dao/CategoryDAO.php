<?php
include_once '../../interface/CategoryCRUD.php';
include_once '../../configuration/DataBaseHelper.php';

 class CategoryDAO implements CategoryCRUD{

    public function selectAll(){
        $query = "CALL sp_basic_category_crud( ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( 0, null, null, null, null, null, 'A') );
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

    public function selectCategory(int $id){
        $query = "CALL sp_basic_category_crud( ?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $id, null, null, null, null, null, 'S') );
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

    public function selectLastCategoryCreatedBy($id){
        $query = "CALL sp_basic_category_crud(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( null, null, null, null, null, $id, 'L') );
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

    public function selectCategoryFromUser(Category $Category){
        $query = "CALL sp_basic_category_crud(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( null, null, null, null, null, null, 'S') );
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

    public function insertCategory(Category $category){
        $query = "CALL sp_basic_category_crud(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( 0, $category->getTitle(), $category->getDescription(), $category->getCover(), $category->getExtension(), $category->getCreatedBy(), 'I') );
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

    public function updateCategory(Category $category, string $option){
        $query = "CALL sp_basic_category_crud(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $category->getId(), $category->getTitle(), $category->getDescription(), $category->getCover(), $category->getExtension(), $category->getCreatedBy(), $option) );
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

    public function deleteCategory(Category $category){
        $query = "CALL sp_basic_category_crud(?, ?, ?, ?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( $category->getId(), null, null, null, null, null, 'D') );
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

    public function selectCategoriesFromCourse(Course $course){
        $query = "CALL sp_bind_course_category(?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( 0, null, $course->getId(), 'S') );
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

    public function selectCategoriesInfo(){
        $query = "CALL sp_bind_course_category(?, ?, ?, ?);";
        $result = [];
        try{
            $connection = new DataBaseHelper();
            $con = $connection->getConnection();

            $statement = $con->prepare($query);

            $statement->execute(array( 0, null, null, 'G') );
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