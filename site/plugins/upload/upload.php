<?php


function uploadImage() {
    $userid = s::get('hasOnlineAccess');
    $success = "";
    $error = "";
    $target_dir = "assets/uploads/";
    $imageFileType = pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION);
    $filename = "user-".$userid.".".$imageFileType;
    $target_file = $target_dir.$filename;
    $uploadOk = 1;
    
    // Check file size
    if ($_FILES["file"]["size"] > 500000) {
        $error = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $error = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $success = "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
        
        $update = array(
            'image' => $filename
        );

        db::update('users', $update, array('id' => $userid));
        
        
        } else {
        $error = "Sorry, there was an error uploading your file."; 
        }
    }

    redirect::to(page('accounts')->url());
}

function uploadPetImage() {
    
        $userid = s::get('hasOnlineAccess');
        $petid = $_POST['petid'];
        $success = "";
        $error = "";
        $target_dir = "assets/uploads/pets/";   
        $imageFileType = pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION);
        $filename = "pet-".$petid.".".$imageFileType;
        $target_file = $target_dir.$filename;
        $uploadOk = 1;
            
        // Check file size
        if ($_FILES["file"]["size"] > 500000) {
            $error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $error = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $success = "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
            
            $update = array(
                'image' => $filename
            );
    
            db::update('pets', $update, array('id' => $petid));
            
            
            } else {
            $error = "Sorry, there was an error uploading your file."; 
            }
        }
        redirect::to(page('accounts')->url());
    }
