<?php
    session_start();
// form submission
    include '../connection.php';
    
    // get array containing rows for nurseries(unassigned)
    $sql = "SELECT * FROM applications 
            WHERE applications.status = 'pending'
            AND applications.evaluator_id = 0";
            
    $result = $conn->query($sql);
    if (isset($_POST['assign'])) {
        // $vlad = strip_tags($_POST['assign']);
        $evalSelection = $_POST['eval'];
       
        for ($i = 0; $i < count($rows=$result->fetch_assoc()); $i++) {
            $application_id = $rows['application_id'];   
                if ($_POST['status'][$i]) {
                    if ($_POST['eval'][$i] == 'unassigned') {
                        if (end($_POST['eval'])) {
                            header('location:../adminPanel.php');
                        } else {
                            continue;
                        } 
                    } else {
                        $update = "UPDATE applications SET evaluator_id='$evalSelection[$i]' WHERE application_id='$application_id'";
                        if ($conn->query($update)) {
                            header('location:../adminPanel.php');
                        } else {
                            header('location:../errorPageSql.php');
                        }
                    }
                } else {
                    $update = "UPDATE applications SET status='rejected' WHERE application_id='$application_id'";
                    if ($conn->query($update)) {
                        continue;
                    } else {
                        header('location:../errorPage.php');
                    }
                    
                
                    $_SESSION['message'] = $_POST['status'];
                    header('location:../errorPage.php');
                } 
        // print_r($_POST['eval']);
        }
        
    }


   
?>