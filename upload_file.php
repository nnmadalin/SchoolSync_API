<?php
    
    ob_start();
    include "database.php";
    ob_end_clean();

    $token  = $_POST["token"];
    $token_valid = "W!WSAnXZLOhyQ6lpt=adAhsOaF5Q...";

    if($data['Database connection'] == 'Failed'){
        $data = ['message' => 'database no connection'];
        echo json_encode( $data );
        die();
    }

    if($token_valid != $token){
        $data = ['message' => 'token invalid'];
        echo json_encode( $data );
        die();
    }

    
    $token_user = $_POST["token_user"];
    $token_user = mysqli_real_escape_string($conn, $token_user);

    $token_file = $_POST["token_file"];
    $token_file = mysqli_real_escape_string($conn, $token_file);

    $filename = $_POST["filename"];
    $filename = mysqli_real_escape_string($conn, $filename);

    if(!isset($token_user) || !isset($token_file) || !isset($filename)){
        $data = ['message' => 'blank post methods'];
        echo json_encode( $data );
        die();
    }

    if (!isset($_FILES['file'])) {
        $data = ['message' => 'no file uploaded'];
        echo json_encode( $data );
        die();
    }
    
    $file = $_FILES["file"];
    if (!($file['error'] === UPLOAD_ERR_OK)) {
        $data = ['message' => 'the file was loaded with errors'];
        echo json_encode( $data );
        die();
    }

    $tempFilePath = $file['tmp_name'];
    $targetDir = '../attachments/' . $token_user;

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $targetDir = $targetDir . "/" . $token_file;

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $targetDir = $targetDir . "/" . $filename;

    if (!move_uploaded_file($tempFilePath, $targetDir)) {
        $data = ['message' => 'problems uploading the file to the server'];
        echo json_encode( $data );
        die();
    }

    $sql="INSERT INTO files (token_user, token, name) VALUES ('$token_user', '$token_file', '$filename')";

    if(mysqli_query($conn, $sql)){
        $data = ['message' => 'success'];
        echo json_encode( $data );
        die(); 
    }
    else{
        $data = ['message' => 'some problems with the insertion in the database'];
        echo json_encode( $data );
        die(); 
    }

?>
