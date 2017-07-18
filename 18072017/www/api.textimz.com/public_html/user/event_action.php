<?php

//backend file to insert event items into db

session_start();
require_once ('./functions.php');
check_login();
/*
if(isset($_SERVER['HTTP_REFERER']) && isset($_POST['headline']) && isset($_POST['content']) && (isset($_POST['is_new']) xor isset($_POST['news_id']) ) ) {
    $ref1 = str_replace("event_action.php", "event.php", "http://".$_SERVER['HTTP_HOST'].''.$_SERVER['PHP_SELF']);
    $ref2 = str_replace("event_action.php", "event.php", "https://".$_SERVER['HTTP_HOST'].''.$_SERVER['PHP_SELF']);
    
    $ref = substr($_SERVER['HTTP_REFERER'],0,strrpos($_SERVER['HTTP_REFERER'],'?'));
    if($ref1 != $ref && $ref2 != $ref && $ref1 != $_SERVER['HTTP_REFERER'] && $ref2 != $_SERVER['HTTP_REFERER']) {
        //echo "$ref1<br>$ref<br>$ref2<br>".$_SERVER['HTTP_REFERER'];
        die("<br>You can't do this1");
    }
    
}
else{
    die("You can't do this2");
}
*/
//var_dump($_FILES);
//image upload
$img_upload = false;
$root_folder = "/production";
if(isset($_FILES["fileToUpload"]["tmp_name"]) && strlen($_FILES["fileToUpload"]["tmp_name"])>0 ) {
    $img_upload = true;    
    $target_dir = "../media/";
    is_dir($target_dir) || mkdir($target_dir);
    $target_file = $target_dir .date('YmdHis'). basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image007 - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
       echo "Sorry, file already exists.";
       $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>$imageFileType file not allowed";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        die("<br>Sorry, your file was not uploaded.");
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
           die ("Sorry, there was an error uploading your file.");
       }
    }

    $img_loc = str_replace("..", "", "http://".$_SERVER['HTTP_HOST'].$root_folder.$target_file);
}
/*
$headline = htmlspecialchars($_POST['headline']);
$content = htmlspecialchars($_POST['content']);
$user = get_user_details();
$uid = intval($user['pk_i_id']);
$time = date('Y-m-d H:i:s');

$secret = substr(str_shuffle(MD5(microtime()).strtoupper(MD5(microtime()+12))), 0, 16);

//ip_address
$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');
*/

echo '$_POST: <br>';
var_dump($_POST);
echo "<br>";
if(isset($_POST['event_id'])) {
    $id = intval($_POST['event_id']);
    $stmt = $conn->prepare("UPDATE t_events SET s_event_name = :event , s_date = :date , s_time = :time, s_venue = :venue, s_details = :details, s_link = :link, s_tags = :tags  WHERE pk_i_id = :id"); 
    $stmt->bindParam(':event', $_POST['event']);
    $stmt->bindParam(':date', $_POST['date']);
    $stmt->bindParam(':time', $_POST['time']);
    $stmt->bindParam(':venue', $_POST['venue']);
    $stmt->bindParam(':details', $_POST['details']);
    $stmt->bindParam(':link', $_POST['link']);
    $stmt->bindParam(':tags', $_POST['tags']);
    $stmt->bindParam(':id', $_POST['id']);
     
    
    
    $stmt->execute();
    unset($stmt);

    
    if($img_upload) {
        
        $stmt = $conn->prepare("INSERT INTO t_media_events (fk_i_item_id, s_media_type, s_source) VALUES (:fkiid, :media_type, :img_loc )");
        $stmt->bindParam(':fkiid', $id);
        $stmt->bindParam(':media_type', $check["mime"]);
        $stmt->bindParam(':img_loc', $img_loc);
        $stmt->execute();
        
        
    }
    require('../web_services/news_detail.php');
    
    header("Location: ./event.php?id=$id");
       
    exit();
} else {
    //$slug = "item-".str_shuffle($secret);
    
    $stmt = $conn->prepare("INSERT INTO t_events (s_event_name, s_date, s_time, s_venue, s_details, s_link, s_tags) VALUES (:event, :date, :time, :venue, :details, :link, :tags)");
    $stmt->bindParam(':event', $_POST['event']);
    $stmt->bindParam(':date', $_POST['date']);
    $stmt->bindParam(':time', $_POST['time']);
    $stmt->bindParam(':venue', $_POST['venue']);
    $stmt->bindParam(':details', $_POST['details']);
    $stmt->bindParam(':link', $_POST['link']);
    $stmt->bindParam(':tags', $_POST['tags']);
    $stmt->execute();
    unset($stmt);
    
    if($img_upload) {
        $stmt = $conn->prepare("SELECT pk_i_id FROM t_events ORDER BY pk_i_id DESC LIMIT 1");
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $current_id = intval($res['pk_i_id']);
        $stmt = $conn->prepare("INSERT INTO t_media_events (fk_i_item_id, s_media_type, s_source) VALUES (:fkiid, :media_type, :img_loc )");
        $stmt->bindParam(':fkiid', $current_id);
        $stmt->bindParam(':media_type', $check["mime"]);
        $stmt->bindParam(':img_loc', $img_loc);
        $stmt->execute();
        
        
    }
    require('../web_services/news_detail.php');
    
    header("Location: ./events.php");
    exit();
    
}




?>