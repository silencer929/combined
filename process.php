<?php
require_once "database.php";
require_once "certify.php";
require_once 'comments.php';
Database::get_instance();
$db= Database::$instance; 
if(isset($_POST["total"])){
    $certify= new Certify();
    $certify->set_score($_POST["total"]);
    $certify->set_nurseryType($_POST['nurseryType']);
    $certify->set_kefri_num($_POST['kefri_num']);
    $certify->set_application_id($_POST['application_id']);
    $result=$certify->evaluate();
    $certify->insert_into_database($db,$result);
    echo json_encode($result);
    die();
}
if(isset($_POST["comment"]) AND isset($_POST['action'])){
    if(empty($_POST['action'])){
        die();
    }
    if(empty($_POST['comment'])){
        die();
    }
    $comment= new Comments();
    $comment->insert_into_database($db,$_POST);
    echo json_encode($_POST);
}
if( isset($_GET['app_id'])){
    $id=$_GET['app_id'];
    $query=" SELECT * FROM nursery NATURAL JOIN applications NATURAL JOIN nursery_details where applications.application_id=(select applications.application_id from applications where applications.application_id=$id) limit 1";
    $query2= "SELECT * from nursery";
    $db->execQuery($query,[]);
    $db->load_data();
    session_start();
    $_SESSION['details']=$db->data[0];
    header("location:inspect.php?app_id=$id");
}
if(isset($_GET['id'])){
    session_destroy();
    unset($_SESSION['details']);
    unset($_GET["id"]);
    unset($_GET['app_id']);
    header("location:evaluatorsProfile.php");
}
?>